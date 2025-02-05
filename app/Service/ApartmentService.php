<?php

namespace App\Service;

use App\Models\Apartment;
use App\Models\Floor;
use Illuminate\Support\Facades\Storage;

class ApartmentService
{
    /**
     * @throws \Exception
     */
    public function store(array $validated)
    {
        if (isset($validated['photos_url'])) {

            $photos = array_map(function ($file) {
                return $file->store('photos_url');
            }, request()->file('photos_url'));

            $validated['photos_url'] = json_encode($photos);

        }

        $floorId = $validated['floor_id'];

        $floor = Floor::query()->findOrFail($floorId);

        $currentApartmentsCount = $floor->apartments()->count();

        $maxApartmentsCount = $floor->apartment_count;

        if ($currentApartmentsCount >= $maxApartmentsCount) {
            return back()->withErrors(['error' => 'Максимальное количество квартир на этом этаже уже достигнуто.']);
        } else {
            return Apartment::query()->create($validated);
        }
    }

    public function update(Apartment $apartment, array $validated)
    {
        if (isset($validated['photos_url'])) {
            $photos = $validated['photos_url'];
            $uploadedPhotos = [];

            foreach ($photos as $photo) {
                $path = $photo->store('apartments', 'public');
                $uploadedPhotos[] = $path;
            }

            $existingPhotos = json_decode($apartment->photos_url) ?: [];
            $allPhotos = array_merge($existingPhotos, $uploadedPhotos);
            $validated['photos_url'] = json_encode($allPhotos);
        }

        $floorId = $validated['floor_id'];

        $floor = Floor::query()->findOrFail($floorId);

        $currentApartmentsCount = $floor->apartments()->count();

        $maxApartmentsCount = $floor->apartment_count;

        if ($currentApartmentsCount >= $maxApartmentsCount) {
            return back()->withErrors(['error' => 'Максимальное количество квартир на этом этаже уже достигнуто.']);
        } else {
            $apartment->update($validated);

            return $apartment->refresh();
        }
    }


    public function destroy(Apartment $apartment): void
    {

        foreach (json_decode($apartment->photos_url) as $photo_url) {
            if (Storage::disk('public')->exists($photo_url)) {
                Storage::disk('public')->delete($photo_url);
            }
        }

        $apartment->delete();
    }
}

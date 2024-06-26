<?php

namespace App\Service;

use App\Models\House;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HouseService
{
    public function store(array $validated): Model|Builder
    {
        $validated['photo_url'] = request()->file('photo_url')->store('photos');
        return House::query()->create($validated);
    }

    public function update(House $house, array $validated): House
    {
        if (isset($validated['photo_url']) && $validated['photo_url']) {
            $validated['photo_url'] = request()->file('photo_url')->store('photos',);

            if (Storage::disk('public')->exists($house->photo_url)) {
                Storage::disk('public')->delete($house->photo_url);
            }
        } else {
            $validated['photo_url'] = $house->photo_url;
        }

        $house->update($validated);

        return $house->refresh();
    }

    public function destroy(House $house): void
    {
        $house->delete();
    }
}

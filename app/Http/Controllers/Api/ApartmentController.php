<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\JsonResponse;

class ApartmentController extends Controller
{
    public function deletePhoto($photoPath, $id): JsonResponse
    {
        $apartment = Apartment::query()->findOrFail($id);

        $photosUrl = json_decode($apartment->photos_url);

        $urlId = array_search('photos_url/' . $photoPath, $photosUrl);

        if ($urlId !== false) {
            unset($photosUrl[$urlId]);

            $updatedPhotosUrl = json_encode(array_values($photosUrl));

            $apartment->update(['photos_url' => $updatedPhotosUrl]);

            return response()->json(['message' => 'Photo deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Photo not found'], 404);
        }
    }

}

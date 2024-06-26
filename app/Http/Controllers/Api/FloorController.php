<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\JsonResponse;

class FloorController extends Controller
{
    public function getFloorsByHouse(House $house): JsonResponse
    {
        $floors = $house->floor()->get();
        return response()->json($floors);
    }
}

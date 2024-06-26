<?php

namespace App\Service;

use App\Models\Floor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FloorService
{
    public function store(array $validated): Model|Builder
    {
        return Floor::query()->create($validated);
    }

    public function update(Floor $floor, array $validated): Floor
    {
        $floor->update($validated);

        return $floor->refresh();
    }

    public function destroy(Floor $floor): void
    {
        $floor->delete();
    }
}

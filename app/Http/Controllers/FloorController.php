<?php

namespace App\Http\Controllers;

use App\Http\Requests\FloorRequest;
use App\Models\Floor;
use App\Models\House;
use App\Service\FloorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FloorController extends Controller
{
    protected FloorService $floorService;

    public function __construct(FloorService $floorService)
    {
        $this->floorService = $floorService;
    }

    public function index(): View
    {
        $floors = Floor::query()->orderBy('id')->with('house')->get();
        $houses = House::query()->get();
        return view('floor.index', compact('floors', 'houses'));
    }



    public function byHouse(House $house): View
    {
        $floors = $house->floor()->get();
        $houses = House::query()->get();
        return view('floor.index', compact('floors', 'houses'));
    }

    public function create(): View
    {
        $houses = House::query()->get();
        return view('floor.create', compact('houses'));
    }

    public function store(FloorRequest $request): RedirectResponse
    {
        $this->floorService->store($request->validated());
        return redirect()->route('floors.index');
    }

    public function edit(Floor $floor): View
    {
        $houses = House::query()->get();
        return view('floor.edit', compact('floor', 'houses'));
    }

    public function update(Floor $floor, FloorRequest $request): RedirectResponse
    {
        $this->floorService->update($floor, $request->validated());
        return redirect()->route('floors.index');
    }

    public function destroy(Floor $floor): RedirectResponse
    {
        $this->floorService->destroy($floor);
        return redirect()->route('floors.index');
    }
}

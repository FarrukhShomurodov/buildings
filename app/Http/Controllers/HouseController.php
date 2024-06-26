<?php

namespace App\Http\Controllers;

use App\Http\Requests\HouseRequest;
use App\Models\House;
use App\Service\HouseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HouseController extends Controller
{
    protected HouseService $houseService;

    public function __construct(HouseService $houseService)
    {
        $this->houseService = $houseService;
    }

    public function index(): View
    {
        $houses = House::query()->orderBy('id')->get();
        return view('house.index', compact('houses'));

    }

    public function create(): View
    {
        return view('house.create');
    }

    public function store(HouseRequest $request): RedirectResponse
    {
        $this->houseService->store($request->validated());
        return redirect()->route('houses.index');
    }

    public function edit(House $house): View
    {
        return view('house.edit', compact('house'));
    }

    public function update(House $house, HouseRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (!$request->hasFile('photo_url')) {
            $validated['photo_url'] = null;
        }

        $this->houseService->update($house, $validated);

        return redirect()->route('houses.index');
    }

    public function destroy(House $house): RedirectResponse
    {
        $this->houseService->destroy($house);
        return redirect()->route('houses.index');
    }
}

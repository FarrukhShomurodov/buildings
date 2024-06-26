<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentRequest;
use App\Models\Apartment;
use App\Models\House;
use App\Service\ApartmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApartmentController extends Controller
{
    protected ApartmentService $apartmentService;

    public function __construct(ApartmentService $apartmentService)
    {
        $this->apartmentService = $apartmentService;
    }

    public function index(): View
    {
        $apartments = Apartment::query()->get();
        return view('apartment.index', compact('apartments'));
    }

    public function create(): View
    {
        $houses = House::query()->get();
        return view('apartment.create', compact('houses'));
    }

    public function store(ApartmentRequest $request): RedirectResponse
    {
        $this->apartmentService->store($request->validated());
        return redirect()->route('apartments.index');
    }

    public function edit(Apartment $apartment): View
    {
        $houses = House::query()->get();
        return view('apartment.edit', compact('apartment', 'houses'));
    }

    public function update(Apartment $apartment, ApartmentRequest $request): RedirectResponse
    {
        $this->apartmentService->update($apartment, $request->validated());
        return redirect()->route('apartments.index');
    }


    public function destroy(Apartment $apartment): RedirectResponse
    {
        $this->apartmentService->destroy($apartment);
        return redirect()->route('apartments.index');
    }
}

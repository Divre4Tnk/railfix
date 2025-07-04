<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Location::query();

        if ($request) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $locations = $query->latest()->paginate(10);

        return view('lokasi.index', [
            'locations' => $locations,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('lokasi.create');
    }

    public function store(LocationRequest $request)
    {
        $request->validated();

        Location::create($request->only('name'));

        return redirect()->route('location.index')->with('success', 'Location created successfully.');
    }

    public function edit(Location $location)
    {
        return view('lokasi.edit', [
            'location' => $location
        ]);
    }

    public function update(LocationRequest $request, Location $location)
    {
        $request->validated();

        $location->update($request->only('name'));

        return redirect()->route('location.index')->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('location.index')->with('success', 'Location deleted successfully.');
    }
}

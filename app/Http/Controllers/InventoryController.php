<?php

namespace App\Http\Controllers;

use App\Exports\InventoriesExport;
use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;
use App\Models\Location;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $location_id = $request->input('location_id');
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query = Inventory::with('location');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')->orWhere('code', 'like', '%' . $search . '%');
        }

        if ($location_id) {
            $query->where('location_id', $location_id);
        }

        if ($start && $end) {
            $query->whereDate('date_in', '>=', $start)->whereDate('date_in', '<=', $end);
        }

        $inventories = $query->latest()->paginate(10);
        $locations = Location::all();

        return view('inventory.index', compact(
            'inventories', 'locations', 'search', 'location_id', 'start', 'end'
        ));
    }

    public function create()
    {
        $locations = Location::all();
        return view('inventory.create', compact('locations'));
    }

    public function store(InventoryRequest $request)
    {
        $request->validated();

        Inventory::create($request->all());

        return redirect()->route('inventories.index')->with('success', 'Inventory created successfully.');
    }

    public function edit(Inventory $inventory)
    {
        $locations = Location::all();
        return view('inventory.edit', compact('inventory', 'locations'));
    }

    public function update(InventoryRequest $request, Inventory $inventory)
    {
        $request->validated();

        $inventory->update($request->all());

        return redirect()->route('inventories.index')->with('success', 'Inventory updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventories.index')->with('success', 'Inventory deleted successfully.');
    }


    public function print(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query = Inventory::with('location');

        if ($start && $end) {
            $query->whereDate('date_in', '>=', $start)->whereDate('date_in', '<=', $end);
        }

        $inventories = $query->latest()->get();

        return view('inventory.print', [
            'inventories' => $inventories,
            'start' => $start ? date('d-m-Y', strtotime($start)) : null,
            'end' => $end ? date('d-m-Y', strtotime($end)) : null
        ]);
    }

    public function export(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        return Excel::download(new InventoriesExport($start, $end), 'Laporan Inventori.xlsx');
    }
}

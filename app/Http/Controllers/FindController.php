<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Collection;

class FindController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $result = null;

        if ($q) {
            $result = Inventory::where('code',  $q)
                ->orWhere('serial_number',  $q)
                ->first();
        }

        return view('find.index', compact('result'));
    }

    public function findPublic(Request $request)
    {
        $q = $request->input('q');
        $tipe = $request->input('tipe');
        
        $result = null;

        if ($q && $tipe == 'kode') $result = Inventory::where('code',  $q)->first();
        if ($q && $tipe == 'sn') $result = Inventory::where('serial_number',  $q)->first();
        if ($q && $tipe == 'inventaris') $result = Inventory::where('inventory_number',  $q)->first();

        return view('find.public', compact('result'));
    }
}

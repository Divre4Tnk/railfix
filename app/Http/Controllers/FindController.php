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
}

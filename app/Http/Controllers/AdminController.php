<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%");
        })->orderByDesc('created_at')
            ->paginate(5);

        return view('admin.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(AdminRequest $request)
    {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(AdminRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', 'Admin delete successfully.');
    }
}

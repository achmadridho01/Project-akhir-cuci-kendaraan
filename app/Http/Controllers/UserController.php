<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.pengguna.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pengguna.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->role = $request->role;
        $user->save();

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'User berhasil dihapus!');
    }
}

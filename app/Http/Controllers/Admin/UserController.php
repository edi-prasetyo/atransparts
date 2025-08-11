<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'shop'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $shops = Shop::all();
        $user = null;
        // return $roles;
        return view('admin.users.create', compact('roles', 'shops', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
            'shop_id' => 'required|exists:shops,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        $user->roles()->sync([$request->role_id]);
        $user->shop()->sync([$request->shop_id]);

        return redirect()->route('users.index')->with('status', 'User created.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $shops = Shop::all();
        return view('admin.users.edit', compact('user', 'roles', 'shops'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'shop_id' => 'required|exists:shops,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $user->roles()->sync([$request->role_id]);
        $user->shop()->sync([$request->shop_id]);

        return redirect()->route('users.index')->with('status', 'User updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User deleted.');
    }
}

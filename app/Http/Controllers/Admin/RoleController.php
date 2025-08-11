<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuAdmin;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role; // Pastikan model Role ada
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role berhasil dibuat.');
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:roles,name,' . $role->id,
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
    }

    public function editPermissions($roleId)
    {
        $role = Role::with('permissions')->findOrFail($roleId);
        // $permissions = Permission::all();

        $permissions = Permission::all()
            ->groupBy(function ($permission) {
                // Ambil prefix sebelum titik pertama, misalnya 'users' dari 'users.index'
                return explode('.', $permission->route_name)[0] ?? 'other';
            });

        return view('admin.roles.edit_permissions', compact('role', 'permissions'));
    }

    public function updatePermissions(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);

        $request->validate([
            'permissions' => 'array',        // harus array jika ada input
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Sync permissions ke role (hapus yang lama, tambah yang baru)
        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Permissions berhasil diperbarui.');
    }

    // Edit Admin Menu
    public function editMenus($roleId)
    {
        $role = Role::findOrFail($roleId);
        $menus = MenuAdmin::orderBy('group')->orderBy('order')->get();

        return view('admin.roles.edit_menus', compact('role', 'menus'));
    }

    public function updateMenus(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);

        // $request->menus diharapkan array menu_admin_id yang dipilih
        $menuIds = $request->input('menus', []);

        // Sinkronisasi pivot
        $role->menus()->sync($menuIds);

        return redirect()->route('roles.index')->with('success', 'Menus assigned successfully.');
    }
}

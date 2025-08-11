<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuAdmin;
use App\Models\Role;
use Illuminate\Http\Request;

class MenuAdminController extends Controller
{
    public function index()
    {
        $menus = MenuAdmin::with('parent')->orderBy('group')->orderBy('order')->get();
        $roles = Role::all();
        return view('admin.menu_admins.index', compact('menus', 'roles'));
    }

    public function create()
    {
        $parents = MenuAdmin::whereNull('parent_id')->orderBy('order')->get();
        return view('admin.menu_admins.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'route_name' => 'nullable|string',
            'icon' => 'nullable|string',
            'group' => 'nullable|string',
            'parent_id' => 'nullable|exists:menu_admins,id',
            'order' => 'nullable|integer',
        ]);

        MenuAdmin::create($data);

        return redirect()->route('menu_admins.index')->with('success', 'Menu created.');
    }

    public function edit(MenuAdmin $menuAdmin)
    {
        $parents = MenuAdmin::whereNull('parent_id')->where('id', '!=', $menuAdmin->id)->orderBy('order')->get();
        return view('admin.menu_admins.edit', compact('menuAdmin', 'parents'));
    }

    public function update(Request $request, MenuAdmin $menuAdmin)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'route_name' => 'nullable|string',
            'icon' => 'nullable|string',
            'group' => 'nullable|string',
            'parent_id' => 'nullable|exists:menu_admins,id',
            'order' => 'nullable|integer',
        ]);

        $menuAdmin->update($data);

        return redirect()->route('menu_admins.index')->with('success', 'Menu updated.');
    }

    public function destroy(MenuAdmin $menuAdmin)
    {
        $menuAdmin->delete();

        return redirect()->route('menu_admins.index')->with('success', 'Menu deleted.');
    }

    // Fungsi untuk assign permission role ke menu
    public function assignPermission(Request $request, MenuAdmin $menuAdmin)
    {
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);

        $menuAdmin->roles()->sync($request->roles);

        return redirect()->back()->with('success', 'Permissions updated.');
    }
}

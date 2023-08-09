<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuFormRequest;
use App\Models\Menu;
use App\Models\MenuTranslation;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    function index()
    {
        $menus = Menu::orderBy('id', 'asc')->paginate(5);
        return view('admin.menu.index', compact('menus'));
    }
    function create()
    {
        $menus = Menu::all();
        return view('admin.menu.create', compact('menus'));
    }
    function store(MenuFormRequest $request)
    {
        $validatedData = $request->validated();

        $menu = new Menu;
        $menu->slug = $validatedData['slug'];
        $menu->position = $validatedData['position'];
        $menu->link = $validatedData['link'];
        $menu->parent_id = $validatedData['parent_id'];
        $menu->status = $validatedData['status'] == true ? '1' : '0';
        $menu->save();
        return redirect('admin/menus/show/' . $menu->id)->with('message', 'Menu Has Added');
    }
    function show(int $menu_id)
    {
        $menu = Menu::findOrFail($menu_id);
        $menuTranslate = MenuTranslation::where('menu_id', $menu->id)->get();
        // return $menu;
        return view('admin.menu.show', compact('menu', 'menuTranslate'));
    }
    function add_translate(Request $request)
    {
        $menu_translate = new MenuTranslation;
        $menu_translate->menu_id = $request['menu_id'];
        $menu_translate->locale = $request['locale'];
        $menu_translate->name = $request['name'];
        $menu_translate->save();
        return redirect()->back()->with('message', 'Menu Has Added');
    }
    function edit(Menu $menu)
    {
        $menus = Menu::all();
        return view('admin.menu.edit', compact('menu', 'menus'));
    }
    function update(MenuFormRequest $request, $menu)
    {
        $validatedData = $request->validated();
        $menu = Menu::findOrFail($menu);

        $menu->slug = $validatedData['slug'];
        $menu->link = $validatedData['link'];
        $menu->parent_id = $validatedData['parent_id'];
        $menu->position = $validatedData['position'];
        $menu->status = $validatedData['status'] == true ? '1' : '0';
        $menu->update();
        return redirect('admin/menus')->with('message', 'Menu update Succesfully');
    }
}

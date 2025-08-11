<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return view('admin.provinces.index', compact('provinces'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Province::create($request->only('name'));

        return redirect()->back()->with('success', 'Province created successfully.');
    }
    public function show($id)
    {
        $province = Province::with('cities')->findOrFail($id);
        $cities = $province->cities;
        // return $cities;
        return view('admin.provinces.show', compact('province', 'cities'));
    }

    public function update(Request $request, Province $province)
    {
        $request->validate(['name' => 'required']);
        $province->update($request->only('name'));

        return redirect()->back()->with('success', 'Province updated successfully.');
    }

    public function destroy(Province $province)
    {
        $province->delete();
        return redirect()->back()->with('success', 'Province deleted successfully.');
    }

    public function storeCity(Request $request, $provinceId)
    {
        $request->validate(['name' => 'required']);
        $province = Province::findOrFail($provinceId);
        $province->cities()->create(['name' => $request->name]);

        return redirect()->back()->with('success', 'City created successfully.');
    }
    public function updateCity(Request $request, $provinceId, $cityId)
    {
        $request->validate(['name' => 'required']);
        $province = Province::findOrFail($provinceId);
        $city = $province->cities()->findOrFail($cityId);
        $city->update(['name' => $request->name]);

        return redirect()->back()->with('success', 'City updated successfully.');
    }
    public function destroyCity($provinceId, $cityId)
    {
        $province = Province::findOrFail($provinceId);
        $city = $province->cities()->findOrFail($cityId);
        $city->delete();

        return redirect()->back()->with('success', 'City deleted successfully.');
    }

    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->pluck('name', 'id');
        return response()->json($cities);
    }
}

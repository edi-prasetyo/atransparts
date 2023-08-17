<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $vehicles = Vehicle::select('vehicles.*', 'brands.name as brand_name')
            ->leftJoin('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->orderBy('vehicles.id', 'DESC')
            ->paginate(10);
        return view('admin.vehicle.index', compact('vehicles', 'brands'));
    }
    public function create()
    {
        $brands = Brand::all();
        return view('admin.vehicle.create', compact('brands'));
    }
    public function store(Request $request)
    {
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $vehicle = new Vehicle;
        $vehicle->name = $request['name'];
        $vehicle->brand_id = $request['brand_id'];
        if (Vehicle::where('slug', $slugRequest)->exists()) {
            $vehicle->slug = $slug;
        } else {
            $vehicle->slug = $slugRequest;
        }
        $vehicle->status = $request->status == true ? '1' : '0';

        $vehicle->save();
        return redirect('admin/vehicles')->with('message', 'Vehicle Has Added');
    }
    function edit(Vehicle $vehicle)
    {
        $brands = Brand::all();
        return view('admin.vehicle.edit', compact('brands', 'vehicle'));
    }
    function update(Request $request, int $vehicle_id)
    {
        $vehicle = Vehicle::findOrFail($vehicle_id);

        $vehicle->brand_id = $request['brand_id'];
        $vehicle->name = $request['name'];
        $vehicle->status = $request->status == true ? '1' : '0';
        $vehicle->update();
        return redirect('admin/vehicles')->with('message', 'Vehicle Has been Updated');
    }
    public function destroy(int $product_id)
    {
        $vehicle = Vehicle::findOrFail($product_id);
        $vehicle->delete();
        return redirect()->back()->with('message', 'vehicle and Image was Deleted!');
    }
}

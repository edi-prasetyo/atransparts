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

        $vehicles = Vehicle::orderBy('id', 'DESC')->paginate(10);
        return view('admin.vehicle.index', compact('vehicles'));
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
        return redirect('admin/vehicles')->with('message', 'Brands Has Added');
    }
}
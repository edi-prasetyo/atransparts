<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role_as', 3)->paginate(10);
        return view('admin.customer.index', compact('customers'));
    }
    public function create()
    {
        return view('admin.customer.create');
    }
    public function store(Request $request)
    {
        $password = 'Customer&*?$@)';
        $user = new User();

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($password);
        $user->role_as = 3;
        $user->save();

        $customer = new UserDetail();
        $customer->user_id = $user->id;
        $customer->province_id = $request['province_id'];
        $customer->city_id = $request['city_id'];
        $customer->company_name = $request['company_name'];
        $customer->company_address = $request['company_address'];

        $customer->save();

        return redirect('admin/customers')->with('message', 'data Berhasil di Input');
    }
    public function edit(Request $request)
    {
    }
    public function update()
    {
    }
    public function destroy()
    {
    }
}

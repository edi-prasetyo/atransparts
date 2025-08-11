<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\ShopUser;

use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function index()
    {
        $query = Customer::orderBy('id', 'desc')->with('shop')->withCount('orders');;


        // Ambil shop_id dari relasi shop_users
        $shopId = ShopUser::where('user_id', Auth::id())
            ->value('shop_id');

        if ($shopId) {
            $query->where('shop_id', $shopId);
        }

        $customers = $query->paginate(5);
        // return $customers;

        return view('admin.customer.index', compact('customers'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('q');

        $results = Customer::where(function ($q) use ($query) {
            $q->where('full_name', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', '%' . $query . '%');
        })
            ->select('id', 'full_name', 'phone', 'address')
            ->limit(10)
            ->get();

        return response()->json($results);
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|unique:customers,phone',
            'address' => 'nullable|string',
        ]);

        Customer::create($request->only('full_name', 'phone', 'address'));

        return redirect()->back()->with('success', 'Customer created successfully.');
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|unique:customers,phone,' . $customer->id,
            'address' => 'nullable|string',
        ]);

        $customer->update($request->only('full_name', 'phone', 'address'));

        return redirect()->back()->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->back()->with('success', 'Customer deleted.');
    }
}

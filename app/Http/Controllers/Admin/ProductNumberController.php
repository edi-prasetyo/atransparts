<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductNumberController extends Controller
{
    public function autocomplete(Request $request)
    {
        $q = $request->get('q');
        Log::info("Autocomplete request for product_numbers with query: $q");

        $data = ProductNumber::with('product')->where('number', 'like', "%{$q}%")
            ->orWhereHas('product', function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%");
            })
            ->limit(10)
            ->get(['id', 'product_id', 'number', 'sell_price']);

        Log::info("Query result:", $data->toArray());

        $result = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'number' => $item->number,
                'product_name' => $item->product->name ?? '',
                'sell_price' => $item->sell_price,
            ];
        });

        Log::info("Mapped result:", $result->toArray());

        return response()->json($result);
    }
}

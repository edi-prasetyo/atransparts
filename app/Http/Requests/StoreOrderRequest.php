<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'customer.id' => 'nullable|exists:customers,id',
            'customer.full_name' => 'required_without:customer.id|string',
            'customer.phone' => 'required_without:customer.id|string',
            'customer.address' => 'required_without:customer.id|string',
            'shop_id' => 'nullable|exists:shops,id',
            'payment_method' => 'required|in:cash,transfer,qris,payment gateway',
            'shipping_cost' => 'nullable|integer',
            'shipping_address' => 'nullable|string',
            'note' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.product_number_id' => 'nullable|exists:product_numbers,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0',
            'items.*.note' => 'nullable|string',
        ];
    }
}

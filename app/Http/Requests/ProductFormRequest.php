<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'production_id' => [
                'required',
                'integer'
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255'
            ],

            'original_price' => [
                'required',

            ],
            'selling_price' => [
                'required',

            ],
            'quantity' => [
                'required',
                'integer',
            ],
            'trending' => [
                'nullable',
            ],
            'status' => [
                'nullable',
            ],

            'image' => [
                'nullable',
                // 'mimes:jpg,jpeg,png'
            ],

        ];
    }
}

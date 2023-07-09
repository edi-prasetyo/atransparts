<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuFormRequest extends FormRequest
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
            'slug' => [
                'nullable',
                'string'
            ],
            'position' => [
                'nullable',
                'string'
            ],
            'link' => [
                'nullable',
                'string'
            ],
            'parent_id' => [
                'nullable',
            ],
            'status' => [
                'nullable',
            ],
        ];
    }
}

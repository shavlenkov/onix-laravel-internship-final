<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'in_stock' => 'required|int',
            'price' => 'required|int',
            'image' => 'image|mimes:png,jpeg,gif',
            'category_ids' => 'required',
        ];
    }
}

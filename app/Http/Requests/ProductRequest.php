<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => "required|string|max:255|unique:products",
            'manufacturer' => "required|max:255|string",
            'price' => "required|integer|min:1",
            'quantity' => "required|integer|min:0"
        ];
    }

    /**
     * Product Validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Product Name Field can not be empty.',
            'name.unique' => 'Product Name already exists.',
            'manufacturer.required' => 'Product Manufacturer Field can not be empty.',
            'price.required' => 'Product Price Field can not be empty.',
            'quantity.required' => 'Product Quantity Field can not be empty.',
            'quantity.min' => 'Product Quantity Field can not be negative.'
        ];
    }
}

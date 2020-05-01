<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => "required|string|min:3|max:255|unique:categories,name,{$this->id}",
            'description' => "required|min:3"
        ];
    }

    /**
     * Category error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Category Name can not be empty.',
            'name.unique' => 'Category Name already exists.',
            'description.required' => 'Category Description can not be empty.'
        ];
    }
}

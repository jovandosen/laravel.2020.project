<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneNumberRequest extends FormRequest
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
            'phone' => "required|max:255|min:6|regex:/^([0-9\s\-\+\(\)]*)$/|unique:phones,phone,{$this->id}"
        ];
    }

    /**
     * Phone Number Validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone.required' => 'Phone Number Field can not be empty.',
            'phone.unique' => 'This Phone Number already exists.'
        ];
    }
}

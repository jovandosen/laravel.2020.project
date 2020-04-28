<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'title' => "required|max:255|unique:movies,title,{$this->id}",
            'description' => 'required|min:3',
            'image' => "required_without:movieImage",
        ];
    }

    /**
     * Movie validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Movie Title can not be empty.',
            'title.unique' => 'Movie with this title already exists.',
            'description.required' => 'Movie Description can not be empty.',
            'image.required' => 'Movie Image can not be empty.',
        ];
    }
}

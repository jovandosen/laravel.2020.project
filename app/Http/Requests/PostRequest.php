<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|unique:posts|max:255',
            'excerpt' => 'required',
            'content' => 'required|min:3',
        ];
    }

    /**
     * Post error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Field Title can not be empty.',
            'title.unique' => 'Post Title already exists.',
            'excerpt.required' => 'Field Excerpt can not be empty.',
            'content.required' => 'Field Content can not be empty.'
        ];
    }
}

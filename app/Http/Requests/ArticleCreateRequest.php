<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:100',
            'slug' => 'required|string|unique:articles|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'excerpt' => 'required|string|max:255',
            'txt' => 'required|string',
            'is_published' => 'required|boolean',
        ];
    }
}


<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends FormRequest
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
            'excerpt' => 'required|string|max:255',

            /**
             * Игнорирование текущего slug при проверке на уникальность в таблице articles
             */

            'slug' =>
                'required|string|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:articles,slug,'
                . $this->article->id,
            'txt' => 'required|string',
            'is_published' => 'required|boolean',
        ];
    }
}

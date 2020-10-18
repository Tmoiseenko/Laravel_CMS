<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        $rule = [
            'title' => 'required|min:5|max:100',
            'slug' => ['required', 'unique:posts'],
            'excerpt' => 'required|max:255',
            'content' => 'required',
            'published' => 'required|boolean',
        ];

        if($this->isMethod('patch')){
            $post = Post::where('slug', $this->slug)->first();
            $rule['slug'] = $post ? true : ['required', 'unique:posts'];
        }

        return $rule;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'published' => (bool) $this->published ,
        ]);
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле Заголовок обязательно для заполнения',
            'slug.required'  => 'Поле Слаг обязательно для заполнения',
            'excerpt.required'  => 'Поле Отрывок обязательно для заполнения',
            'content.required'  => 'Поле Контент обязательно для заполнения',
            'title.min:5'  => 'Поле Заголовок должно быть не короче 5 символов',
            'title.max:100'  => 'Поле Заголовок должно быть не более 100 символов',
            'excerpt.max:255'  => 'Поле Отрывок должно быть не более 255 символов',
            'excerpt.unique'  => 'Поле Отрывок должно быть не более 255 символов',
        ];
    }
}

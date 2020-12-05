<?php

namespace App\Http\Requests;

use App\Comment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentRequest extends FormRequest
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
        return $rule = [
            'name' => 'required|max:255',
            'email' => 'required',
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле Имя обязательно для заполнения',
            'email.required'  => 'Поле Email обязательно для заполнения',
            'message.required'  => 'Поле Сообщение обязательно для заполнения',
            'name.max:255'  => 'Поле Имя должно быть не более 255 символов',
        ];
    }
}

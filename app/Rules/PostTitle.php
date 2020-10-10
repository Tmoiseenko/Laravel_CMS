<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PostTitle implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return 'required|min:5|max:100';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Поле заголовок должно быть не менее 5 и не более 255 символов';
    }
}

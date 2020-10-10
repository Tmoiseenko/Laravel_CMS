<?php

namespace App\Rules;

use App\Post;
use Illuminate\Contracts\Validation\Rule;

class PostUpdateSlug implements Rule
{
    protected $post;
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
        $post = Post::where($attribute, $value)->first();
        return $post ? true : ['required', 'unique:posts'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

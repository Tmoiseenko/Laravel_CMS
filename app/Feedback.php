<?php

namespace App;

use Illuminate\Support\Facades\Cache;

class Feedback extends Model
{
    public $tagsArr = ['feedbacks'];

    protected static function boot()
    {
        parent::boot();
    }
}

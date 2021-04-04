<?php

namespace App;

use Illuminate\Support\Facades\Cache;

class Feedback extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(fn() => Cache::tags(['feedbacks'])->flush());
        static::updating(fn() => Cache::tags(['feedbacks'])->flush());
        static::deleting(fn() => Cache::tags(['feedbacks'])->flush());
    }
}

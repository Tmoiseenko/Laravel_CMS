<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public $fillable = ['name', 'email', 'message'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'commentable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'commentable');
    }

    public function scopeTakeRandom($query, $size=1)
    {
        return $query->inRandomOrder()->take($size);
    }
}

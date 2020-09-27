<?php

namespace App;

class Post extends Model
{
    public $fillable = ['title', 'slug', 'excerpt', 'content', 'published', 'user_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

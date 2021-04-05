<?php

namespace App;

use Illuminate\Support\Facades\Cache;

class News extends Model
{
    public $fillable = ['title', 'slug', 'excerpt', 'content', 'published'];

    public $tagsArr = ['news'];

    protected static function boot()
    {
        parent::boot();
    }

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
        return $this->morphToMany(Tag::class, 'tagable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}

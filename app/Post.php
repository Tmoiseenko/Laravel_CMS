<?php

namespace App;

class Post extends Model
{
    public $fillable = ['title', 'slug', 'excerpt', 'content', 'published', 'user_id'];
    protected $rules = [
        'title' => 'required|min:5|max:100',
        'slug' => 'required|unique:posts,slug',
        'excerpt' => 'required|max:255',
        'content' => 'required',
    ];

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

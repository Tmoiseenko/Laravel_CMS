<?php

namespace App;

use App\Events\AdminNotifyUpdatePost;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    public $fillable = ['title', 'slug', 'excerpt', 'content', 'published', 'user_id'];

    public $tagsArr = ['posts'];

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Post $post){
            $after = $post->getDirty();
            event(new AdminNotifyUpdatePost([
                'title' => $post->title,
                'link' => route('post.show', $post->slug),
                'changes' => $after,
            ]));
            $post->history()->attach(auth()->id(), [
                'before' => json_encode(Arr::only($post->fresh()->toArray(), array_keys($after))),
                'after' => json_encode($after),
            ]);
        });
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function history()
    {
        return $this->belongsToMany(\App\User::class, 'post_histories')
            ->withPivot(['before', 'after'])
            ->withTimestamps();
    }

}

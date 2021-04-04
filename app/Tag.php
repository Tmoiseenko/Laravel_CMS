<?php

namespace App;

use App\Events\AdminNotifyUpdatePost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{

    public $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::creating(fn() => Cache::tags(['tags'])->flush());
        static::updating(fn() => Cache::tags(['tags'])->flush());
        static::deleting(fn() => Cache::tags(['tags'])->flush());
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'tagable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'tagable');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public static function tagsCloud()
    {
        return (new static)->has('posts')->get();
    }

    public function scopeTakeRandom($query, $size=1)
    {
        return $query->orderBy(DB::raw('RAND()'))->take($size);
    }

    public function tagable()
    {
        return $this->morphTo();
    }

}

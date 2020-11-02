<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    public $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
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
}

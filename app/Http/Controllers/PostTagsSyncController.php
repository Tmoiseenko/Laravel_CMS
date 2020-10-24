<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostTagsSyncController extends Controller
{
    public function sync(Post $post)
    {
        $postTags = $post->tags->keyBy('name');
        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; } );
        $syncIds = $postTags->intersectByKeys($tags)->pluck('id')->toArray();
        $postToAttach = $tags->diffKeys($postTags);

        foreach ($postToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $post->tags()->sync($syncIds);
    }
}

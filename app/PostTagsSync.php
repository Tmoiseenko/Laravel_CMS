<?php

namespace App;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostTagsSync
{
    public function sync(Model $post, $requestTags)
    {
        $postTags = $post->tags->keyBy('name');
        $tags = collect(explode(',', $requestTags))->keyBy(function ($item) { return $item; } );
        $syncIds = $postTags->intersectByKeys($tags)->pluck('id')->toArray();
        $postToAttach = $tags->diffKeys($postTags);

        foreach ($postToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $post->tags()->sync($syncIds);
    }
}

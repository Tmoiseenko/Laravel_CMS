<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\News::class, rand(25, 55))->create()->each(function (\App\News $post) {
            $tagsIds = \App\Tag::takeRandom(rand(2, 5))->get('id');
            $post->tags()->sync($tagsIds);
            $post->comments()->saveMany(factory(\App\Comment::class, rand(3, 7))->make());
        });
    }
}

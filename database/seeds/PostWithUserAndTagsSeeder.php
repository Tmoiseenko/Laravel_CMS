<?php

use App\Tag;
use Illuminate\Database\Seeder;

class PostWithUserAndTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        while (5 > $i ) {
            factory(\App\Post::class, 5)->create([
                'user_id' => \App\User::takeRandom()->first()
            ])->each(function (\App\Post $post) {
                $tagsIds = Tag::takeRandom(rand(2, 5))->get('id');
                $post->tags()->sync($tagsIds);
            });
            $i++;
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\Post\Post;
use App\Models\Tag\Tag;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
            ->count(5)
            ->create()->each(fn(Post $post) => $post->tags()->sync(Tag::pluck('id')->random(rand(1, 7))));
    }
}

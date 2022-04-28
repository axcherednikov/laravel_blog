<?php

namespace Database\Seeders;

use App\Models\Post\Post;
use App\Models\Tag\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(2)->create()->each(fn(User $user) => $user->posts()->saveMany(Post::factory()
            ->count(10)
            ->create(['owner_id' => $user])->each(fn(Post $post) => $post->tags()->sync(Tag::pluck('id')->random(rand(1, 5))))));
    }
}

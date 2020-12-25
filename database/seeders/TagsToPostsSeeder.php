<?php

namespace Database\Seeders;

use App\Models\Post\Tag;
use Illuminate\Database\Seeder;

class TagsToPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()->count(40)->create();
    }
}

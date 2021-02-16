<?php

namespace Database\Seeders;

use App\Models\Tag\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
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

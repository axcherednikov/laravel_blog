<?php

namespace Database\Seeders;

use App\Models\News\News;
use App\Models\Tag\Tag;
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
        News::factory()
            ->count(10)
            ->create()->each(function (News $news) {
                $news->tags()->sync(Tag::pluck('id')->random(rand(1, 5)));
            });
    }
}

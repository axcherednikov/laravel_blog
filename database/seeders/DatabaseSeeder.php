<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TagsSeeder::class,
            PostsSeeder::class,
            TasksSeeder::class,
            NewsSeeder::class,
            StepsSeeder::class,
            PostsToUsersSeeder::class,
            UsersTableSeeder::class,
            TasksToUserSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Tag\Tag;
use App\Models\Task\Step;
use App\Models\Task\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::first()
            ->tasks()
            ->saveMany(Task::factory()
                ->count(5)
                ->create()->each(function (Task $task) {
                    $task->tags()->sync(Tag::pluck('id')->random(rand(1, 6)));

                    $task->steps()
                        ->saveMany(
                            Step::factory()
                                ->count(rand(2, 6))
                                ->create()
                                ->each(fn(Step $step) => $step
                                    ->tags()
                                    ->sync(
                                        Tag::pluck('id')->random(rand(1, 4))
                                    )
                                )
                        );
                }));

        Task::factory()
            ->count(5)
            ->create()->each(fn(Task $task) => $task->tags()->sync(Tag::pluck('id')->random(rand(1, 7))));
    }
}

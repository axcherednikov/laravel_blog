<?php

namespace Database\Seeders;

use App\Models\Task\Step;
use App\Models\Task\Task;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class TasksToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create(['email' => 'admin2@admin.ru', 'password' => Hash::make('1234')]);

        factory(Task::class, 5)->create([
            'owner_id' => $user
        ])->each(function (Task $task) {
            $task->steps()->saveMany(factory(Step::class, rand(1, 5))->make(['task_id' => '']));
        });
    }
}

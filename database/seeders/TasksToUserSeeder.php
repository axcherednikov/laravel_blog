<?php

namespace Database\Seeders;

use App\Models\Task\Step;
use App\Models\Task\Task;
use App\Models\User;
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
        $user = User::factory()->create(['email' => 'admin2@admin.ru', 'password' => \Hash::make('1234')]);

        Task::factory()->count(5)->create([
            'owner_id' => $user
        ])->each(function (Task $task) {
            $task->steps()->saveMany(Step::factory()->count(rand(1, 5))->create())->make(['task_id' => '']);
        });
    }
}

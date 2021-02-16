<?php

namespace Database\Seeders;

use App\Models\Task\Step;
use App\Models\Task\Task;
use Illuminate\Database\Seeder;

class StepsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Step::factory()
            ->count(30)
            ->create(['task_id' => Task::pluck('id')->random()]);
    }
}

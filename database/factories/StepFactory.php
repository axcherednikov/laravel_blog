<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factories\Factory $factory */

use App\Models\Task\Step;
use App\Models\Task\Task;
use Faker\Generator as Faker;

$factory->define(Step::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'task_id' => factory(Task::class),
    ];
});

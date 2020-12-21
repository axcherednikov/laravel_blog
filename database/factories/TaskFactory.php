<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factories\Factory $factory */

use App\Models\Task\Task;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->words(3, true),
        'body' => $faker->sentence,
        'owner_id' => factory(User::class),
    ];
});

<?php

namespace Database\Factories\Task;

use App\Models\Task\Step;
use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class StepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Step::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'task_id' => Task::factory()->create(),
        ];
    }
}

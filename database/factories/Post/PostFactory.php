<?php

namespace Database\Factories\Post;

use App\Models\Post\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => User::factory(),
            'slug' => $this->faker->slug('3'),
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence('7'),
            'body' => $this->faker->text(500),
            'publish' => true,
        ];
    }
}

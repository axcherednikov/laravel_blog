<?php

namespace Database\Factories\News;

use App\Models\News\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'slug' => $this->faker->slug(5),
            'description' => $this->faker->sentence(10),
            'body' => $this->faker->text(500),
            'publish' => true,
        ];
    }
}

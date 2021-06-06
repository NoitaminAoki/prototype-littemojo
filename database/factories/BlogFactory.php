<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'img' => 'public/files/article1.png',
            'content' => $this->faker->paragraph(),
            'is_publish' => $this->faker->boolean(60),
            'is_highlight' => $this->faker->boolean(30),
            'user_id' => rand(1, Partner::count())
        ];
    }
}

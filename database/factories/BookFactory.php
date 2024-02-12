<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 10),
            'title' => fake()->sentence(),
            'author' => fake()->name(),
            'pages' => fake()->numberBetween(50, 500),
            'genre' => fake()->word(),
            'publish_year' => fake()->year(),
            'read' => fake()->boolean(),
            'date_read' => fake()->date(),
        ];
    }
}

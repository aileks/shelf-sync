<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
  public function definition(): array
  {
    $genresData = json_decode(file_get_contents(database_path('../resources/data/genres.json')), true);
    $genre = $this->faker->randomElement($genresData['genres']);

    return [
      'user_id' => fake()->numberBetween(1, 10),
      'title' => fake()->sentence(),
      'author' => fake()->name(),
      'pages' => fake()->numberBetween(50, 500),
      'genre' => $genre,
      'publish_year' => fake()->year(),
      'read' => fake()->boolean(),
      'finished' => fake()->boolean(),
      'date_read' => fake()->date(),
    ];
  }
}

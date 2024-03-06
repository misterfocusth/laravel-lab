<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => $this->faker->unique()->sentence(3),
            'description' => $this->faker->paragraph(4),
            'publisher' => $this->faker->company(),
            'pages' => $this->faker->numberBetween(100, 1000),
            'rating' => $this->faker->randomElement(['EVERYONE', 'TEEN', 'ADULT']),
            'release_date' => $this->faker->date(),
            'cover_image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 0, 2000)
        ];
    }
}

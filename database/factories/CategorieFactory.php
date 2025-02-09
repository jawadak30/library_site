<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class CategorieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Science Fiction', 'Mystery', 'Fantasy', 'Romance', 'Thriller', 'Biography',
                'Self-Help', 'History', 'Philosophy', 'Technology', 'Education', 'Poetry'
            ]),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}

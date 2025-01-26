<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livre>
 */
class LivreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence(),
            'auteur' => $this->faker->name(),
            'editeur' => $this->faker->company(),
            'date_edition' => $this->faker->date(),
            'nbr_exemplaire' => $this->faker->numberBetween(1, 100),
            'categorie_id' => Categorie::factory(),
        ];
    }
}

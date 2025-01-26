<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dateEmprunt' => $this->faker->date(),
            'heureEmprunt' => $this->faker->time(),
            'dateReservation' => $this->faker->date(),
            'etat' => $this->faker->randomElement(['en attente', 'confirmée', 'annulée']),
            'user_id' => \App\Models\User::factory(),
            'livre_id' => \App\Models\Livre::factory(),
        ];
    }
}

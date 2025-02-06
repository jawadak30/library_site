<?php

namespace Database\Factories;

use \App\Models\Livre;
use \App\Models\User;
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
        $dateReservation = now()->toDateString(); // Current date
        $finDateReservation = now()->addWeek()->toDateString();
        return [
            'dateEmprunt' => $this->faker->date(),
            'heureEmprunt' => $this->faker->time(),
            'dateReservation' => $dateReservation,
            'fin_dateReservation' => $finDateReservation,
            'etat' => $this->faker->randomElement(['en attente', 'confirmée', 'annulée']),
            'user_id' => User::factory(),
            'livre_id' => Livre::factory(),
        ];
    }
}

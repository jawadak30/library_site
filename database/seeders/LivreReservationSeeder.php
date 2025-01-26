<?php

namespace Database\Seeders;

use \App\Models\Livre;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LivreReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $livres = Livre::all();
        Reservation::all()->each(function ($reservation) use ($livres) {
            $reservation->livres()->attach(
                $livres->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}

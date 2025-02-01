<?php

namespace Database\Seeders;

use App\Models\Categorie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Livre;
use App\Models\Profile;
use App\Models\Reservation;
use App\Models\User;
use Database\Seeders\LivreReservationSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Categorie::factory(5)->create()->each(function ($category) {
            Livre::factory(3)->create(['categorie_id' => $category->id]);
        });

        // Create users with profiles and reservations
        User::factory(10)->create()->each(function ($user) {
            Profile::factory()->create(['user_id' => $user->id]);
            Reservation::factory(count: 2)->create(['user_id' => $user->id]);
        });

        $this->call(LivreReservationSeeder::class);

    }
}

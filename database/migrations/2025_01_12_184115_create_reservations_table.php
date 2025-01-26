<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('dateEmprunt');
            $table->time('heureEmprunt');
            $table->date('dateReservation');
            $table->enum('etat',['en attente', 'confirmée', 'annulée'])->default('en attente');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('livre_id')->constrained('livres')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id' ,
        'livre_id',
        'dateEmprunt',
        'heureEmprunt',
        'dateReservation',
        'fin_dateReservation',
        'etat',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function livres()
    {
        return $this->belongsToMany(Livre::class, 'livre_reservation', 'reservation_id', 'livre_id');
    }
}

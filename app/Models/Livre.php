<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livre extends Model
{
    /** @use HasFactory<\Database\Factories\LivreFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'titre' ,
        'auteur',
        'editeur' ,
        'date_edition',
        'nbr_exemplaire',
        'categorie_id' ,
    ];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'livre_reservation', 'livre_id', 'reservation_id');
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Livre;
use App\Models\Profile;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function hasRole($role){
        return $this->getAttribute('role') === $role;
    }

    public function isAdmin(){
        return $this->hasRole('admin');
    }

    public function isUser(){
        return $this->hasRole('user');
    }


    public function redirectAuthUser(){
        if ($this->isAdmin()) {
            return redirect()->intended(route('admin_dashboard')); // Redirect to intended URL or admin dashboard
        }

        if ($this->isUser()) {
            return redirect()->intended(route('welcome')); // Redirect to intended URL or welcome page
        }
    }
    public function profile(){
        $this->hasOne(Profile::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function livresReserved()
    {
        return $this->belongsToMany(Livre::class, 'livre_reservation', 'reservation_id', 'livre_id');
    }
}

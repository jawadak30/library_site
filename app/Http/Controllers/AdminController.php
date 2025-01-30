<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Livre;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        // Count total records
        $totalUsers = User::count();
        $totalCategories = Categorie::count();
        $totalLivres = Livre::count();
        $totalReservations = Reservation::count();

        // Get last login time of the admin
        $lastLogin = Auth::user()->last_login ?? now()->subDay(); // Default: 1 day ago if not available

        // Count new reservations since last authentication
        $newReservations = Reservation::where('created_at', '>', $lastLogin)->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCategories',
            'totalLivres',
            'totalReservations',
            'newReservations'
        ));
    }
}

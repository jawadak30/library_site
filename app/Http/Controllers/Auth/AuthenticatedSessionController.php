<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Categorie;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $categories = Categorie::with('livres')->get(); // Fetch categories with books
        return view('auth.login', compact('categories'));;
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user (for both new and already logged-in users)
        $request->authenticate();

        // Regenerate the session to prevent session fixation attacks
        $request->session()->regenerate();

        // Get the currently authenticated user
        $user = Auth::user();

        // Update the last login timestamp
        $user->update(['last_login' => now()]);

        // Check if there are any books in the session cart
        $cart = session('cart', []);

        // If the cart is not empty and the user is authenticated, attempt to reserve the books
        if (!empty($cart)) {
            $reservedBooks = []; // To track books that are already reserved
            $newReservations = []; // To track books that are being newly reserved

            // Loop through the books in the cart
            foreach ($cart as $bookId) {
                // Check if the book has already been reserved by this user
                $existingReservation = Reservation::where('user_id', $user->id)
                                                  ->where('livre_id', $bookId)
                                                  ->exists();

                if ($existingReservation) {
                    // Skip the reserved books
                    $reservedBooks[] = $bookId;
                } else {
                    // Reserve the book if it's not already reserved
                    Reservation::create([
                        'user_id' => $user->id,
                        'livre_id' => $bookId,
                        'dateEmprunt' => now()->toDateString(), // Current date
                        'heureEmprunt' => now()->toTimeString(), // Current time
                        'dateReservation' => now()->toDateString(), // Current date
                        'etat' => 'en attente', // Default status
                    ]);

                    $newReservations[] = $bookId;
                }
            }

            // Clear the cart after reserving the books
            session()->forget('cart');

            // Prepare a message based on the success and reserved books
            $message = count($newReservations) . ' book(s) reserved successfully!';

            // If any books were already reserved, include that info in the message
            if (count($reservedBooks) > 0) {
                $message .= ' Some books were already reserved and were skipped.';
            }

            // Flash the message to the session
            session()->flash('message', $message);
        }
        // Redirect the user based on where they should go after login
        return $user->redirectAuthUser();

    }




    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}

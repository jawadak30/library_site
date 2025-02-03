<?php
namespace App\Http\Controllers;

use \Log;
use App\Models\Categorie;
use App\Models\Livre;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Display all reservations
    public function all_reservations()
    {
        // Fetch reservations with their associated user and livres
        $reservations = Reservation::with(['user', 'livres'])->get();
        return view('admin.reservations.all_reservations', compact('reservations'));
    }

    // Show form to add a new reservation
    public function reservation_form_add()
    {
        $users = User::where('role', 'user')->get();
        $books = Livre::all();
        return view('admin.reservations.add_reservation', compact('users', 'books'));
    }


// ReservationController.php

    public function reserveBooks()
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please log in to complete your reservation.');
        }

        // User is authenticated, proceed with the reservation
        $user = auth()->user();
        $cart = session('cart', []); // Retrieve the cart from the session

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $reservedBooks = []; // To store books that were already reserved
        $newReservations = []; // To store books that are being newly reserved

        // Loop through each book in the cart
        foreach ($cart as $bookId) {
            // Check if the user has already reserved this book
            $existingReservation = Reservation::where('user_id', $user->id)
                                            ->where('livre_id', $bookId)
                                            ->exists();

            if ($existingReservation) {
                // If the book is already reserved, add it to the reservedBooks array
                $reservedBooks[] = $bookId;
            } else {
                // If the book has not been reserved, add it to the newReservations array
                $newReservations[] = $bookId;
            }
        }

        // Now, create reservations for the books that were not reserved yet
        foreach ($newReservations as $bookId) {
            Reservation::create([
                'user_id' => $user->id,
                'livre_id' => $bookId,
                'dateEmprunt' => now()->toDateString(), // Current date
                'heureEmprunt' => now()->toTimeString(), // Current time
                'dateReservation' => now()->toDateString(), // Current date
                'etat' => 'en attente', // Default status
            ]);
        }

        // Clear the cart after reserving
        session()->forget('cart');

        // Prepare the message
        $message = count($newReservations) . ' book(s) reserved successfully!';

        // If there are any reserved books, include that information
        if (count($reservedBooks) > 0) {
            $message = ' Some books were already reserved and were skipped.';
        }
        // return redirect()->route('');

        return back()->with('message', $message);
    }




    // Store a new reservation
    public function add_reservation(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'livre_id' => 'required|exists:livres,id',
            'dateEmprunt' => 'required|date|after_or_equal:today',
            'heureEmprunt' => 'required',
            'dateReservation' => 'required|date|after_or_equal:today',
            'etat' => 'required|in:en attente,confirmée,annulée',
        ]);

        $reservation = Reservation::create([
            'user_id' => $request->user_id,
            'dateEmprunt' => $request->dateEmprunt,
            'heureEmprunt' => $request->heureEmprunt,
            'dateReservation' => $request->dateReservation,
            'etat' => $request->etat,
        ]);

        $reservation->livres()->attach($request->livre_id);

        return redirect()->route('all_reservations')->with('success', 'Réservation ajoutée avec succès');
    }

    // Show form to update a reservation
    public function reservation_form_update($id)
    {
        $reservation = Reservation::findOrFail($id);
        $users = User::where('role', 'user')->get();
        $livres = Livre::all();
        return view('admin.reservations.update_reservation', compact('reservation', 'users', 'livres'));
    }

    // Update reservation details
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'livre_id' => 'required|exists:livres,id',
            'dateEmprunt' => 'required|date|after_or_equal:today',
            'heureEmprunt' => 'required',
            'dateReservation' => 'required|date|after_or_equal:today',
            'etat' => 'required|in:en attente,confirmée,annulée',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'user_id' => $request->user_id,
            'dateEmprunt' => $request->dateEmprunt,
            'heureEmprunt' => $request->heureEmprunt,
            'dateReservation' => $request->dateReservation,
            'etat' => $request->etat,
        ]);

        $reservation->livres()->sync($request->livre_id);

        return redirect()->route('all_reservations')->with('success', 'Réservation mise à jour avec succès');
    }

    public function showUpdateEmpruntForm($reservationId, $bookId)
    {
        $categories = Categorie::with('livres')->get();
        $reservation = Reservation::findOrFail($reservationId);
        $book = Livre::findOrFail($bookId);
        // dd($categories,$reservation,$book);

        if (!$reservation || !$book) {
            return back()->with('error', 'Reservation or book not found');
        }

        return view('components.update_reservation', compact('reservation', 'book', 'categories'));

    }




    public function updateEmpruntDate(Request $request, $reservationId)
    {
        $reservation = Reservation::find($reservationId);

        if (!$reservation) {
            abort(404); // Handle the case if reservation is not found
        }

        // Get current date
        $nowDate = now()->format('Y-m-d');  // Current date in 'YYYY-MM-DD' format

        // Validate the incoming data
        $request->validate([
            'dateEmprunt' => 'required|date|after_or_equal:' . $nowDate, // Ensure the date is today or in the future
            'heureEmprunt' => 'required|date_format:H:i', // Validate time format
        ]);

        // Update the reservation
        $reservation->dateEmprunt = $request->dateEmprunt;
        $reservation->heureEmprunt = $request->heureEmprunt;

        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Loan date updated successfully.');
    }







    public function deleteBook($reservationId, $bookId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $book = Livre::findOrFail($bookId);

        // Detach the book from the reservation (removes the relationship)
        $reservation->livres()->detach($bookId);

        return back()->with('success', 'Book removed from reservation.');
    }
    public function updateReservationDate(Request $request, $reservationId)
    {
        $request->validate([
            'newDate' => 'required|date',
        ]);

        $reservation = Reservation::findOrFail($reservationId);
        $reservation->dateReservation = $request->newDate;
        $reservation->save();

        return back()->with('success', 'Reservation date updated.');
    }


    // Delete a reservation
    public function destroy(Request $request)
    {
        $reservation = Reservation::findOrFail($request->id);
        $reservation->delete();

        return redirect()->route('all_reservations')->with('success', 'Réservation supprimée avec succès');
    }
}

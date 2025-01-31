<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Livre;
use Illuminate\Http\Request;

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

    // Delete a reservation
    public function destroy(Request $request)
    {
        $reservation = Reservation::findOrFail($request->id);
        $reservation->delete();

        return redirect()->route('all_reservations')->with('success', 'Réservation supprimée avec succès');
    }
}

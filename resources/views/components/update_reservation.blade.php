@extends('base')
@push('styles')
@vite('resources/css/mediaqueries.css')
    @vite('resources/css/header.css')
    @vite('resources/css/main.css')
@endpush
@section('header')
    <x-header :categories="$categories" />
@endsection
@section('section')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-calendar"></i> Update Loan Date for "{{ $book->titre }}"</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('reservations_updateEmpruntDate', ['reservation' => $reservation->id, 'book' => $book->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Display Book Information -->
                <div class="mb-3">
                    <strong>Book Title:</strong> {{ $book->titre }}
                    <br>
                    <strong>Author:</strong> {{ $book->auteur }}
                    <br>
                    <strong>Edition Date:</strong> {{ $book->date_edition }}
                </div>

                <!-- Loan Date (Emprunt Date) Input -->
                <!-- Loan Date (Emprunt Date) Input -->
                <div class="form-group">
                    <label for="fin_dateReservation">Reservation End Date</label>
                    <input type="date" name="fin_dateReservation" id="fin_dateReservation" class="form-control"
                           value="{{ old('fin_dateReservation', $reservation->fin_dateReservation ?? now()->addDay()->format('Y-m-d')) }}"
                           min="{{ old('fin_dateReservation', $reservation->fin_dateReservation ?? now()->format('Y-m-d')) }}">
                </div>


                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

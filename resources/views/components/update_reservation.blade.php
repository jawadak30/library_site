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
            <h4 class="mb-0"><i class="fas fa-calendar"></i> {{ trans('mainTrans.update') }} "{{ $book->titre }}"</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('reservations_updateEmpruntDate', ['reservation' => $reservation->id, 'book' => $book->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Display Book Information -->
                <div class="mb-3">
                    <strong>{{ trans('mainTrans.book_title') }}:</strong> {{ $book->titre }}
                    <br>
                    <strong>{{ trans('mainTrans.author') }}:</strong> {{ $book->auteur }}
                    <br>
                    <strong>{{ trans('mainTrans.edition_date') }}:</strong> {{ $book->date_edition }}
                </div>

                <!-- Loan Date (Emprunt Date) Input -->
                <!-- Loan Date (Emprunt Date) Input -->
                <div class="form-group">
                    <label for="fin_dateReservation">{{ trans('mainTrans.fin_date_reservation') }}</label>
                    <input type="date" name="fin_dateReservation" id="fin_dateReservation" class="form-control"
                           value="{{ old('fin_dateReservation', $reservation->fin_dateReservation ?? now()->addDay()->format('Y-m-d')) }}"
                           min="{{ old('fin_dateReservation', $reservation->fin_dateReservation ?? now()->format('Y-m-d')) }}">
                </div>


                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success">{{ trans('mainTrans.update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

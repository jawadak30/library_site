@extends('basedashboard')
@section('aside')
@include('admin.admin_components.aside')
@endsection

@section('nav')
    @include('admin.admin_components.nav')
@endsection
@section('banner')
    @include('admin.admin_components.banner')
@endsection

@section('container_fluid')
<div class="container-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Update Reservation</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Form -->
                        <form action="{{ route('update_reservation', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <!-- Date d'Emprunt Field -->
                            <div class="form-group">
                                <label for="dateEmprunt">Date d'Emprunt</label>
                                <input type="date" name="dateEmprunt" id="dateEmprunt" class="form-control @error('dateEmprunt') is-invalid @enderror" value="{{ old('dateEmprunt', $reservation->dateEmprunt) }}">
                                @error('dateEmprunt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Heure d'Emprunt Field -->
                            <div class="form-group">
                                <label for="heureEmprunt">Heure d'Emprunt</label>
                                <input type="time" name="heureEmprunt" id="heureEmprunt" class="form-control @error('heureEmprunt') is-invalid @enderror" value="{{ old('heureEmprunt', $reservation->heureEmprunt) }}">
                                @error('heureEmprunt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date de Réservation Field -->
                            <div class="form-group">
                                <label for="dateReservation">Date de Réservation</label>
                                <input type="date" name="dateReservation" id="dateReservation" class="form-control @error('dateReservation') is-invalid @enderror" value="{{ old('dateReservation', $reservation->dateReservation) }}" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                                @error('dateReservation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="fin_dateReservation">Date de Fin de Réservation</label>
                                <input type="date" name="fin_dateReservation" id="fin_dateReservation" class="form-control @error('fin_dateReservation') is-invalid @enderror" value="{{ old('fin_dateReservation', $reservation->fin_dateReservation) }}" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                                @error('fin_dateReservation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- État Field -->
                            <div class="form-group">
                                <label for="etat">État</label>
                                <select name="etat" id="etat" class="form-control @error('etat') is-invalid @enderror">
                                    <option value="en attente" {{ old('etat', $reservation->etat) == 'en attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="confirmée" {{ old('etat', $reservation->etat) == 'confirmée' ? 'selected' : '' }}>Confirmée</option>
                                    <option value="annulée" {{ old('etat', $reservation->etat) == 'annulée' ? 'selected' : '' }}>Annulée</option>
                                </select>
                                @error('etat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- User Field -->
                            <div class="form-group">
                                <label for="user_id">Utilisateur</label>
                                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', $reservation->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Livre Field -->
                            <div class="form-group">
                                <label for="livre_id">Livre</label>
                                <select name="livre_id" id="livre_id" class="form-control @error('livre_id') is-invalid @enderror">
                                    @foreach($livres as $livre)
                                        <option value="{{ $livre->id }}" {{ old('livre_id', $reservation->livre_id) == $livre->id ? 'selected' : '' }}>{{ $livre->titre }}</option>
                                    @endforeach
                                </select>
                                @error('livre_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Update Reservation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('settings')
    @include('admin.admin_components.settings')
@endsection


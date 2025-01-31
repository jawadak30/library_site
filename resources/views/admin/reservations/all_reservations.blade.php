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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Reservations</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date d'Emprunt</th>
                                    <th>Heure d'Emprunt</th>
                                    <th>Date de Réservation</th>
                                    <th>État</th>
                                    <th>Utilisateur</th>
                                    <th>Livres</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->dateEmprunt }}</td>
                                    <td>{{ $reservation->heureEmprunt }}</td>
                                    <td>{{ $reservation->dateReservation }}</td>
                                    <td>
                                        <span class="badge
                                            @if($reservation->etat == 'en attente') bg-warning
                                            @elseif($reservation->etat == 'confirmée') bg-success
                                            @elseif($reservation->etat == 'annulée') bg-danger
                                            @endif">
                                            {{ $reservation->etat }}
                                        </span>
                                    </td>
                                    <td>{{ $reservation->user?->name ?? 'N/A' }}</td>
                                    <td>
                                        @forelse($reservation->livres as $livre)
                                            {{ $livre->titre }}<br>
                                            <hr class="hr-horizontal">
                                        @empty
                                            N/A
                                        @endforelse
                                    </td>
                                    <td>
                                        <!-- Update Button -->
                                        <form action="{{ route('reservation_form_update', $reservation->id) }}" method="GET" style="display: inline;">
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </form>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reservation->id }}">Delete</button>
                                    </td>
                                </tr>

                                <!-- Delete Modal for each reservation -->
                                <div class="modal fade" id="deleteModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $reservation->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $reservation->id }}">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the reservation for the following books?<br>
                                                @forelse($reservation->livres as $livre)
                                                    - {{ $livre->titre }}<br>
                                                @empty
                                                    No books associated.
                                                @endforelse
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('destroy_reservation') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
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


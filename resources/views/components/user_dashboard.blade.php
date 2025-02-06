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
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">My Reserved Books</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="custom-datatable-entries">
                <!-- Reserved Books Table (using classes from the first table) -->
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Edition Date</th>
                            <th>Category</th>
                            <th>Reservation Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                        @foreach($reservation->livres as $book)

                            <tr>
                                <td>{{ $book->titre }}</td>
                                <td>{{ $book->auteur }}</td>
                                <td>{{ $book->date_edition }}</td>
                                <td>{{ $book->categorie->name ?? 'No category' }}</td>
                                <td>{{ $reservation->dateReservation ?? 'N/A' }}</td>

                                <td>
                                    @if($reservation->fin_dateReservation < now()->toDateString())
                                        <span class="text-danger">Expired</span>
                                    @else
                                        <span class="text-success">Active</span>
                                    @endif

                                    @if($reservation->etat == 'confirmée')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($reservation->etat == 'annulée')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>


                                <td>
                                    <form action="{{ route('reservations.deleteBook', ['reservation' => $reservation->id, 'book' => $book->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Book</button>
                                    </form>
                                    <a href="{{ route('updateEmpruntDate', ['reservation' => $reservation->id, 'book' => $book->id]) }}" class="btn btn-warning btn-sm">
                                        Update Date
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Include DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    new DataTable('#datatable', {
        scrollX: true,  
    });
</script>

@endsection

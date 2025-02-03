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
                                <td>{{ ucfirst($reservation->etat) ?? 'N/A' }}</td>
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
        scrollX: true,  // Enable horizontal scroll
  // Set default number of rows per page
    });
    // Wait for the document to be ready before adding event listeners
    document.addEventListener("DOMContentLoaded", function() {
        // Get all the buttons that open the modal
        const openModalButtons = document.querySelectorAll('.open-modal-btn');

        openModalButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                // Get the reservation ID from the button's data-reservation-id attribute
                const reservationId = this.getAttribute('data-reservation-id');

                // Get the modal by the reservation ID
                const modal = document.getElementById('updateDateModal' + reservationId);

                // Show the modal by adding the 'show' class and setting display to block
                modal.classList.add('show');
                modal.style.display = 'block'; // Make sure the modal is visible

                // Set the modal's aria-hidden attribute to false (to make it visible)
                modal.setAttribute('aria-hidden', 'false');

                // Disable body scroll when modal is open
                document.body.style.overflow = 'hidden';

                // Close the modal when the close button is clicked
                const closeButton = modal.querySelector('.btn-close');
                closeButton.addEventListener('click', function() {
                    modal.classList.remove('show');
                    modal.style.display = 'none';
                    modal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = ''; // Re-enable body scroll
                });
            });
        });
    });
</script>

@endsection

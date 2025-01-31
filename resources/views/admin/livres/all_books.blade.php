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
                        <h4 class="card-title">Books</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Editeur</th>
                                    <th>Date d'édition</th>
                                    <th>Nombre d'exemplaires</th>
                                    <th>Catégorie</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->titre }}</td>
                                    <td>{{ $book->auteur }}</td>
                                    <td>{{ $book->editeur }}</td>
                                    <td>{{ $book->date_edition }}</td>
                                    <td>{{ $book->nbr_exemplaire }}</td>
                                    <td>{{ $book->categorie->name }}</td>
                                    <td>
                                        <!-- Update Button -->
                                        <form action="{{ route('book_form_update', $book->id) }}" method="GET" style="display: inline;">
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </form>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $book->id }}">Delete</button>
                                    </td>
                                </tr>

                                <!-- Delete Modal for each book -->
                                <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $book->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $book->id }}">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the book "{{ $book->titre }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('destroy_book') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $book->id }}">
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


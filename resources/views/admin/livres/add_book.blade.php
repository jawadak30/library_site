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
                            <h4 class="card-title">Add New Book</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add_book') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Titre Field -->
                            <div class="form-group">
                                <label for="titre">Titre</label>
                                <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre') }}" >
                                @error('titre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Auteur Field -->
                            <div class="form-group">
                                <label for="auteur">Auteur</label>
                                <input type="text" name="auteur" id="auteur" class="form-control @error('auteur') is-invalid @enderror" value="{{ old('auteur') }}" >
                                @error('auteur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Editeur Field -->
                            <div class="form-group">
                                <label for="editeur">Editeur</label>
                                <input type="text" name="editeur" id="editeur" class="form-control @error('editeur') is-invalid @enderror" value="{{ old('editeur') }}" >
                                @error('editeur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date d'édition Field -->
                            <div class="form-group">
                                <label for="date_edition">Date d'édition</label>
                                <input type="date" name="date_edition" id="date_edition" class="form-control @error('date_edition') is-invalid @enderror" value="{{ old('date_edition') }}" >
                                @error('date_edition')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nombre d'exemplaires Field -->
                            <div class="form-group">
                                <label for="nbr_exemplaire">Nombre d'exemplaires</label>
                                <input type="number" name="nbr_exemplaire" id="nbr_exemplaire" class="form-control @error('nbr_exemplaire') is-invalid @enderror" value="{{ old('nbr_exemplaire') }}" >
                                @error('nbr_exemplaire')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Catégorie Field -->
                            <div class="form-group">
                                <label for="categorie_id">Catégorie</label>
                                <select name="categorie_id" id="categorie_id" class="form-control @error('categorie_id') is-invalid @enderror" >
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('categorie_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categorie_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image1 Field -->
                            <div class="form-group">
                                <label for="image1">Image 1</label>
                                <input type="file" name="image1" id="image1" class="form-control @error('image1') is-invalid @enderror">
                                @error('image1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image2 Field -->
                            <div class="form-group">
                                <label for="image2">Image 2</label>
                                <input type="file" name="image2" id="image2" class="form-control @error('image2') is-invalid @enderror">
                                @error('image2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add Book</button>
                            </div>
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


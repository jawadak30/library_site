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
<div class="product-main">
    <h2 class="title">Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <!-- Reserve All Button -->
        @auth
        <!-- Authenticated users -->
        <form action="{{ route('reserveBooks') }}" method="POST">
            @csrf
            <button type="submit">Reserve All Books</button>
        </form>
    @endauth

    @guest
        <!-- Guest users -->
        <form action="{{ route('guest.reserveBooks') }}" method="POST">
            @csrf
            <button type="submit" class="btn-action">Reserver Tout</button>
        </form>
    @endguest


        <div class="product-grid">
            @foreach(session('cart') as $bookId)
                @php
                    $livre = \App\Models\Livre::find($bookId);
                @endphp

                @if ($livre)
                    <div class="showcase">
                        <div class="showcase-banner">
                            <img src="{{ asset('storage/' . $livre->image1) }}" alt="{{ $livre->titre }}" width="300" class="product-img default">
                            <img src="{{ asset('storage/' . $livre->image2) }}" alt="{{ $livre->titre }}" width="300" class="product-img hover">
                            <div class="showcase-actions">
                                <a class="btn-action view-book" href="{{ route('guest_book', $livre->id) }}">
                                    <ion-icon name="eye-outline"></ion-icon>
                                </a>

                                <form action="{{ route('removeFromCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $livre->id }}">
                                    <button type="submit" class="btn-action">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="showcase-content">
                            <a href="#" class="showcase-category">Category: {{ $livre->categorie->name }}</a>
                            <h3><a href="#" class="showcase-title">Title: {{ $livre->titre }}</a></h3>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <p>No books in the cart.</p>
    @endif
</div>





{{-- <div class="product-main">

    <h2 class="title">New Products</h2>

    <div class="product-grid">
      @foreach ($livres as $livre )
      <div class="showcase">

          <div class="showcase-banner">

            <img src="{{ asset('storage/' . $livre->image1) }}" alt="Mens Winter Leathers Jackets" width="300" class="product-img default">
            <img src="{{ asset('storage/' . $livre->image2) }}" alt="Mens Winter Leathers Jackets" width="300" class="product-img hover">


            <div class="showcase-actions">


              <a class="btn-action view-book" href="{{ route('guest_book',$livre->id) }}"><ion-icon name="eye-outline"></ion-icon></a>

              <form action="{{ route('addToCart') }}" method="POST">
                  @csrf
                  <input type="hidden" name="book_id" value="{{ $livre->id }}">
                  <button type="submit" class="btn-action"><ion-icon name="bag-add-outline"></ion-icon></button>
              </form>

            </div>

          </div>

          <div class="showcase-content">
              <a href="#" class="showcase-category">category : {{ $livre->categorie->name }}</a>
              <h3><a href="#" class="showcase-title">title : {{ $livre->titre }}</a></h3>


          </div>

        </div>
      @endforeach
    </div>
    <div class="pagination-links">
      {{ $livres->links() }}
  </div>

  </div> --}}



@endsection


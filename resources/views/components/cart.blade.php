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
    <h2 class="title" >{{ trans('mainTrans.cart') }}</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <!-- Reserve All Button -->
        @auth
        <!-- Authenticated users -->
        <form id="reserver" action="{{ route('reserveBooks') }}" method="POST" style="dispaly:flex !important; justify-content: center !important;">
            @csrf
            <button type="submit">{{ trans('mainTrans.reserve_all_books') }}</button>
        </form>
    @endauth

    @guest
        <!-- Guest users -->
        <form id="reserver" action="{{ route('guest.reserveBooks') }}" method="POST" style="dispaly:flex !important; justify-content: center !important;">
            @csrf
            <button type="submit" class="btn-action">{{ trans('mainTrans.reserve_all_books') }}</button>
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


                                @auth
                                    <a class="btn-action view-book" href="{{ route('auth_book', $livre->id) }}">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </a>
                                    <form action="{{ route('removeFromCart_user') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $livre->id }}">
                                        <button type="submit" class="btn-action">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </form>
                                @endauth

                                @guest
                                    <a class="btn-action view-book" href="{{ route('guest_book', $livre->id) }}">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </a>
                                    <form action="{{ route('removeFromCart_guest') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $livre->id }}">
                                        <button type="submit" class="btn-action">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </form>
                                @endguest

                            </div>
                        </div>
                        <div class="showcase-content">
                            <a href="#" class="showcase-category">{{ trans('mainTrans.category') }}: {{ $livre->categorie->name }}</a>
                            <h3><a href="#" class="showcase-title">{{ trans('mainTrans.title') }}: {{ $livre->titre }}</a></h3>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <p class="alert alert-primary" role="alert" >No books in the cart.</p>
    @endif
</div>



@endsection


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
<div class="product-featured">
    <div class="showcase-wrapper has-scrollbar">
        <div class="showcase-container">
            <div class="showcase">
                <div class="showcase-banner">
                    <img src="{{ asset('storage/' . $livre->image1) }}" alt="{{ $livre->titre }}" class="showcase-img">
                    <img src="{{ asset('storage/' . $livre->image2) }}" alt="{{ $livre->titre }}" class="showcase-img">
                </div>

                <div class="showcase-content">

                    <h3 class="showcase-title"><strong>Title:</strong> {{ $livre->titre }}</h3>

                    <p><strong>{{ trans('mainTrans.author') }}:</strong> {{ $livre->auteur }}</p>
                    <p><strong>{{ trans('mainTrans.editor') }}:</strong> {{ $livre->editeur }}</p>
                    <p><strong>{{ trans('mainTrans.edition_date') }}:</strong> {{ \Carbon\Carbon::parse($livre->date_edition)->format('Y-m-d') }}
                    </p>

                    <div class="showcase-status">
                        <div class="wrapper">
                            <p><strong>{{ trans('mainTrans.nombre_books') }}:</strong>{{ $livre->nbr_exemplaire }}</b></p>
                        </div>
                    </div>

                    @auth
                        <form action="{{ route('addToCart_user') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $livre->id }}">
                            <button type="submit" class="add-cart-btn">{{ trans('mainTrans.add_to_cart') }}</button>
                        </form>
                    @endauth
                    @guest
                    <form action="{{ route('addToCart_guest') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $livre->id }}">
                        <button type="submit" class="add-cart-btn">{{ trans('mainTrans.add_to_cart') }}</button>
                    </form>
                    @endguest



                </div>
            </div>
        </div>
    </div>
</div>



@endsection


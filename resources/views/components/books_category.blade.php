@extends('base')
@section('header')
    <x-header  :categories="$categories"/>
@endsection
@section('section')
    <x-main :livres="$livres" />
@endsection
@section('footer')
    <x-footer />
@endsection

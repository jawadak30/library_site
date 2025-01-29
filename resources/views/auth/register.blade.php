@extends('base')
@push('styles')
    @vite('resources/css/form.css')
@endpush
@section('header')
    <x-header />
@endsection
@section('section')
{{-- <x-guest-layout> --}}
<div class="cont">
    <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto">
        @csrf

        <!-- Name -->
        <div class="relative mt-6">
            <input
                id="name"
                name="name"
                type="text"
                class="floating-input"
                placeholder=" "
                required
                autofocus
                autocomplete="name"
            />
            <label for="name" class="floating-label">Name</label>
            @error('name')
            <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="relative mt-6">
            <input
                id="email"
                name="email"
                type="email"
                class="floating-input"
                placeholder=" "
                required
                autocomplete="username"
            />
            <label for="email" class="floating-label">Email</label>
            @error('email')
            <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="relative mt-6">
            <input
                id="password"
                name="password"
                type="password"
                class="floating-input"
                placeholder=" "
                required
                autocomplete="new-password"
            />
            <label for="password" class="floating-label">Password</label>
            @error('password')
            <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="relative mt-6">
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="floating-input"
                placeholder=" "
                required
                autocomplete="new-password"
            />
            <label for="password_confirmation" class="floating-label">Confirm Password</label>
            @error('password_confirmation')
            <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">Already registered?</a>
            <button
                type="submit"
                class="ml-4 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring focus:ring-indigo-300">
                Register
            </button>
        </div>
    </form>
</div>

{{-- </x-guest-layout> --}}
@endsection

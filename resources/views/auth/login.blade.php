@extends('base')
@push('styles')
    @vite('resources/css/form.css')
@endpush
@section('header')
    <x-header />
@endsection
@section('section')
<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="cont">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="relative mt-6">
            <input
                id="email"
                name="email"
                type="email"
                class="floating-input"
                placeholder=" "
                required
                autofocus
                autocomplete="username"
            />
            <label for="email" class="floating-label">Email</label>
            @error('email')
                <p class="error-text">{{ $message }}</p>
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
                autocomplete="current-password"
            />
            <label for="password" class="floating-label">Password</label>
            @error('password')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a
                    class="text-sm text-gray-600 hover:underline dark:text-gray-400"
                    href="{{ route('password.request') }}"
                >
                    Forgot your password?
                </a>
            @endif

            <button
                type="submit"
                class="ml-4 px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2"
            >
                Log in
            </button>
        </div>
    </form>

</div>
@endsection



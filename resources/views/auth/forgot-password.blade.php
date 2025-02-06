@extends('base')
@push('styles')
    @vite('resources/css/form.css')
@endpush
@section('section')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="password-reset-form">
        @csrf

        <!-- Email Address -->
        <div class="relative">
            <input
                id="email"
                type="email"
                name="email"
                class="floating-input"
                placeholder=" "
                value="{{ old('email') }}"
                required
                autofocus
            />
            <label for="email" class="floating-label">{{ trans('mainTrans.email') }}</label>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->

        <button
        type="submit"
        class="ml-4 px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">Email Password Reset Link</button>
    </form>

@endsection

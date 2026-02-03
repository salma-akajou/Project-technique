@extends('layouts.app')

@section('content')
<div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm max-w-md mx-auto">
    <div class="p-4 sm:p-7">
        <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800">{{ __('Login') }}</h1>
            <p class="mt-2 text-sm text-gray-600">
                {{ __('Don\'t have an account yet?') }}
                <a class="text-blue-600 decoration-2 hover:underline font-medium" href="{{ route('register') }}">
                    {{ __('Sign up here') }}
                </a>
            </p>
        </div>

        <div class="mt-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="grid gap-y-4">
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm mb-2">{{ __('Email Address') }}</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="h-5 w-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('email')
                        <p class="text-xs text-red-600 mt-2" id="email-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between items-center">
                            <label for="password" class="block text-sm mb-2">{{ __('Password') }}</label>
                            @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 decoration-2 hover:underline font-medium" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required autocomplete="current-password">
                            @error('password')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="h-5 w-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('password')
                        <p class="text-xs text-red-600 mt-2" id="password-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <div class="flex">
                            <input id="remember" name="remember" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500" {{ old('remember') ? 'checked' : '' }}>
                        </div>
                        <div class="ms-3">
                            <label for="remember" class="text-sm">{{ __('Remember Me') }}</label>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



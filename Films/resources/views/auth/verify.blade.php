@extends('layouts.app')

@section('content')
<div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm max-w-md mx-auto">
    <div class="p-4 sm:p-7">
        <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800">{{ __('Verify Your Email Address') }}</h1>
        </div>

        <div class="mt-5">
            @if (session('resent'))
            <div class="bg-green-100 border border-green-200 text-sm text-green-800 rounded-lg p-4 mb-4" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif

            <p class="text-sm text-gray-600 mb-4">
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
            </p>

            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="text-blue-600 decoration-2 hover:underline font-medium p-0 m-0 border-0 bg-transparent cursor-pointer">
                    {{ __('click here to request another') }}
                </button>.
            </form>
        </div>
    </div>
</div>
@endsection



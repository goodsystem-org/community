@extends('layout')

@section('title')
    Log in
@endsection

@section('content')
    <div class="bg-gray-50 flex flex-col pt-4 pb-12 sm:px-6 lg:px-8">
        @csrf
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-4 text-center text-3xl leading-9 font-extrabold text-gray-900">
                {{ __('Verify Your Email Address') }}
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto lg:w-full lg:max-w-xl">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                @if (session('resent'))
                    <div class="text-green-400 mb-2" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p class="mb-2">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                <div class=""mb-2>{{ __('If you did not receive the email') }},
                    <form class="mt-2 inline-block" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="underline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

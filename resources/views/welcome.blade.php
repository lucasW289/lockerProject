@extends('layouts.app')

@section('title', 'Register')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome-style.css') }}">
@endsection

@section('content')

    <div class="flex-grow pt-4 bg-gray-100">
        <div class="flex flex-col items-center pt-6 sm:pt-0">
            <div>
                
            </div>
                <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                    <p>{{ __('Welcome to the locker portal of the Förderverein of Primo-Levi-Gymnasium! Log in now to submit your locker request. With your account, you can then view the processing status of your booking at any time and provide us with all relevant payment and contract data.')}}</p>
                </div>

                <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                    <a  href="{{ url('/register') }}" class="mb-4 mt-4">{{ __('Register') }}</a>
                </div>

                <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                <a  href="{{ url('/login') }}" class="mb-4 mt-4">{{ __('Log in') }}</a>
                </div>

                <div class="w-full sm:max-w-2xl mt-6 mb-2 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                    <p>{{ __('If you have any questions about your tenancy agreement, your locker or any other concerns, please contact')}}</p>
                                <a  href="mailto:schliessfach@primolevi.de" class="mb-4 mt-4">schliessfach&commat;primolevi.de</a>
                </div>
        </div>
    </div>


@endsection
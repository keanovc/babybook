@extends('layouts.master')

@section('content')
    <section class="h-screen">
        <div class="px-6 h-full text-gray-800">
        <div
            class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6"
        >
            <div class="bg-[#1E3A4C] h-auto px-16 py-16 rounded-3xl w-10/12 xl:ml-20 xl:w-3/12 lg:w-5/12 md:w-10/12 mb-12 md:mb-0">
                <div class="flex items-center justify-center text-3xl uppercase font-bold mb-20 xl:mb-10">
                    <img
                        src="../img/logo.svg"
                        class="w-6/12 xl:w-6/12 lg:w-6/12 md:w-9/12 mb-12 mt-6 xl:mt-0 md:mb-5"
                        alt="Sample image"
                    />
                </div>

                <form method="POST" action="{{ route('guestlist') }}">
                    @csrf

                    <div>
                        @if (session('error'))
                            <div class="alert alert-danger text-red-500 mb-2">
                                {{ session('error') }}
                            </div>
                        @endif
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <x-input id="invitation_code" class="block text-2xl lg:text-base mt-10 w-full h-24 xl:h-12" type="password" name="invitation_code" placeholder="{{ __('Invitation Code') }}" required autofocus />
                    </div>

                    <div class="mt-5">
                        <x-button class="bg-[#9EC4C5] uppercase text-2xl xl:text-base lg:text-base h-24 xl:h-12 l:h-12">
                            {{ __('Send') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection

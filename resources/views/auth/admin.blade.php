@extends('layouts.master')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="h-screen">
        <div class="px-6 h-full text-gray-800">
        <div
            class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6"
        >
            <div
            class="grow-0 shrink-1 md:shrink-0 basis-auto xl:w-4/12 lg:w-6/12 md:w-9/12 mb-12 md:mb-0"
            >
            <img
                src="../img/admin.svg"
                class="w-full"
                alt="Sample image"
            />
            </div>
            <div class="bg-[#1E3A4C] h-3/6 px-16 py-10 rounded-3xl w-10/12 xl:ml-20 xl:w-3/12 lg:w-5/12 md:w-10/12 mb-12 md:mb-0">
                <div class="flex items-center justify-center text-3xl uppercase font-bold mb-20 xl:mb-10">
                    <img
                        src="../img/logo.svg"
                        class="w-6/12 xl:w-6/12 lg:w-6/12 md:w-9/12 mb-12 mt-6 xl:mt-0 md:mb-0"
                        alt="Sample image"
                    />
                </div>

                <x-header/>

                <form method="POST" action="{{ route('admin') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        @if (session('error'))
                            <div class="alert alert-danger text-red-500 mb-2">
                                {{ session('error') }}
                            </div>
                        @endif
                        <x-input id="email" class="block text-2xl xl:text-base lg:text-base mt-1 w-full h-20 xl:h-12 l:h-12" type="email" name="email" placeholder="{{ __('Email') }}" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input id="password" class="block text-2xl xl:text-base lg:text-base mt-1 w-full h-20 xl:h-12 l:h-12"
                                        type="password"
                                        name="password"
                                        placeholder="{{ __('Password') }}"
                                        required autocomplete="current-password" />

                        @if (Route::has('password.request'))
                            <div class="flex items-center justify-end mt-4">
                                <a class="text-right text-2xl xl:text-base lg:text-base text-gray-400 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="mt-10">
                        <x-button class="bg-[#9EC4C5] uppercase text-2xl xl:text-base lg:text-base h-16 xl:h-12 l:h-12">
                            {{ __('Login') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection

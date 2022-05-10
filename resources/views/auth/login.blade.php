@extends('layouts.master')

@section('content')
    <section class="h-screen">
        <div class="px-6 h-full text-gray-800">
        <div
            class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6"
        >
            <div
            class="grow-0 shrink-1 md:shrink-0 basis-auto xl:w-4/12 lg:w-6/12 md:w-9/12 mb-12 md:mb-0"
            >
            <img
                src="../img/mom.svg"
                class="w-full"
                alt="Sample image"
            />
            </div>
            <div class="bg-[#1E3A4C] h-3/6 px-16 py-10 rounded-3xl xl:ml-20 xl:w-3/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
                <div class="flex items-center justify-center text-3xl uppercase font-bold mb-10">
                    <img
                        src="../img/logo.svg"
                        class="w-6/12"
                        alt="Sample image"
                    />
                </div>

                <x-header/>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        @if (session('error'))
                            <div class="alert alert-danger text-red-500 mb-2">
                                {{ session('error') }}
                            </div>
                        @endif
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <x-input id="email" class="block mt-1 w-full h-12" type="email" name="email" placeholder="{{ __('Email') }}" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input id="password" class="block mt-1 w-full h-12"
                                        type="password"
                                        name="password"
                                        placeholder="{{ __('Password') }}"
                                        required autocomplete="current-password" />

                        @if (Route::has('password.request'))
                            <div class="flex items-center justify-end mt-4">
                                <a class="text-right text-sm text-gray-400 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    {{-- <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div> --}}

                    <div class="mt-10">
                        <x-button class="bg-[#9EC4C5] uppercase">
                            {{ __('Login') }}
                        </x-button>
                    </div>

                    <div class="flex items-center justify-center mt-8">
                        <a class="text-white  hover:text-[#F3C2C2]" href="{{ route('register') }}">
                            {{ __("Don't have an account?") }} <span class="text-[#F3C2C2]">{{ __('Sign up here') }}</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection

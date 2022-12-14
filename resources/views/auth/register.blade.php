<x-auth-layout>
    <div class="min-w-screen min-h-screen flex items-center justify-center px-5 py-5">
        <div class="bg-[#1E3A4C] bg-opacity-60 backdrop-filter backdrop-blur-lg text-gray-400 rounded-xl md:rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
            <div class="md:flex w-full">
                <div class="hidden md:flex w-1/2 py-10 px-10 items-center">
                    <img
                        src="../img/mom.svg"
                        class="w-full"
                        alt="Sample image"
                    />
                </div>
                <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                    <div class="text-center mb-10">
                        <h1 class="font-bold text-3xl text-white uppercase">{{ __('Register') }}</h1>
                        <p class="text-gray-300">{{ __('Enter your information to register') }}</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">{{ __('Name') }}</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                                    <input type="text" id="name" name="name" class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="John">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">{{ __('Email') }}</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                    <input type="email" id="email" name="email" class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="johnsmith@example.com">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">{{ __('Password') }}</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                    <input required type="password" id="password" name="password" class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:blue-indigo-500" placeholder="************">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3 mb-10">
                            <div class="w-full px-3">
                                <label for="" class="text-xs font-semibold px-1">{{ __('Confirm Password') }}</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                    <input required type="password" id="password_confirmation" name="password_confirmation" class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:blue-indigo-500" placeholder="************">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">{{ __('REGISTER NOW') }}</button>
                            </div>
                        </div>
                        <div class="flex items-center justify-center mt-4">
                            <a class="text-gray-400 hover:text-gray-300 text-md xl:text-base lg:text-base" href="{{ route('login') }}">
                                {{ __("Already have an account?") }} {{ __('Sign in here') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>

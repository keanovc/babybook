<x-auth-layout>
    <div class="min-w-screen min-h-screen flex items-center justify-center px-5 py-5">
        <div class="bg-[#1E3A4C] lg:bg-transparent text-gray-500 rounded-xl md:rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
            <div class="md:flex w-full">
                <div class="hidden md:flex w-1/2 py-10 px-10 items-center">
                    <img
                        src="../img/mom.svg"
                        class="w-full"
                        alt="Sample image"
                    />
                </div>
                <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                    {{-- <div class="flex items-center justify-center text-3xl uppercase font-bold mb-20 xl:mb-10">
                        <img
                            src="../img/logo.svg"
                            class="w-6/12 xl:w-6/12 lg:w-6/12 md:w-9/12 mb-12 mt-6 xl:mt-0 md:mb-0"
                            alt="Sample image"
                        />
                    </div> --}}
                    <div class="text-center mb-10">
                        <h1 class="font-bold text-3xl text-white uppercase">Login</h1>
                        <p>Enter your information to login</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                @if (session('error'))
                                    <div class="alert alert-danger text-red-500 mb-2">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <label for="" class="text-xs font-semibold px-1">Email</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                    <input required type="email" id="email" name="email" class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:blue-indigo-500" placeholder="johnsmith@example.com">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3">
                                <label for="" class="text-xs font-semibold px-1">Password</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                    <input required type="password" id="password" name="password" class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:blue-indigo-500" placeholder="************">
                                </div>
                            </div>
                        </div>
                        @if (Route::has('password.request'))
                            <div class="flex items-center justify-end mt-4 mb-10">
                                <a class="text-right text-md xl:text-base lg:text-base text-gray-400 hover:text-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            </div>
                        @endif
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold uppercase">{{ __('Login') }}</button>
                            </div>
                        </div>
                        <div class="flex items-center justify-center mt-4">
                            <a class="text-white text-md xl:text-base lg:text-base hover:text-indigo-500" href="{{ route('register') }}">
                                {{ __("Don't have an account?") }} <span class="text-indigo-500">{{ __('Sign up here') }}</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>

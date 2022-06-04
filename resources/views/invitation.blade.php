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
                        <h1 class="font-bold text-3xl text-white">{{ __('BABY INVITE') }}</h1>
                        <p class="text-gray-300">{{ __('Enter your invitation code from the parents') }}</p>
                    </div>
                    <form method="GET" action="{{ route('guestlist') }}">
                        @if (session('error'))
                            <div class="flex p-4 mb-2 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                <div>
                                    <span class="font-medium">{{ session('error') }}</span>
                                </div>
                            </div>
                        @endif
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">{{ __('Invitation Code') }}</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                    <input required type="password" id="invitation_code" name="invitation_code" class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:blue-indigo-500" placeholder="************">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">{{ __('Send') }}</button>
                            </div>
                        </div>
                        <div class="flex items-center justify-center mt-4">
                            <a class="text-gray-400 hover:text-gray-300 text-center text-md xl:text-base lg:text-base" href="{{ route('register') }}">
                                {{ __('Want to create a list yourself?') }} {{ __('Sign up here') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>

<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg md:flex md:justify-around md:items-center">
            <a href="{{ route('dashboard') }}" class="hidden md:block">
                <img class="h-8 w-auto" src="../../img/logob.svg" alt="">
            </a>
            <div class="flex">
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-indigo-500 group-hover:text-indigo-500">
                        <a href="{{ route('dashboard') }}" class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                list_alt
                            </span>
                            <span class="block text-xs pb-2">{{ __('Lists') }}</span>
                            <span class="block w-5 mx-auto h-1 bg-indigo-500 group-hover:bg-indigo-500 rounded-full"></span>
                        </a>
                    </div>
                </div>
                <div class="flex-1 group">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <div type="button" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                            <button onclick="event.preventDefault(); this.closest('form').submit();" class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined group-hover:text-indigo-500">
                                    logout
                                </span>
                                <span class="block text-xs pb-2">{{ __('Logout') }}</span>
                                <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="w-10/12 mx-auto md:w-3/12 mt-10 md:mt-20 text-[#1E3A4C]">
        <div class="flex items-center justify-between mb-5 px-1">
            <h1 class="text-xl uppercase font-bold">{{ __('Create list') }}</h1>
            <a href="{{ route('dashboard') }}" class="text-black focus:ring-gray-300 font-medium rounded-md text-sm">
                <span class="material-symbols-outlined">
                    close
                </span>
            </a>
        </div>
        <hr class="my-5 mx-auto border-[#1E3A4C]">
        <form  action="{{ route('addlist.store') }}" method="POST">
            @csrf

            <div class="flex -mx-3">
                <div class="w-full px-3 mb-5">
                    <label for="name" class="text-xs font-semibold px-1">{{ __('Name') }}</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                        <input type="text" id="name" name="name" class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="John Doe" required>
                    </div>
                </div>
            </div>
            <div class="flex -mx-3">
                <div class="w-full px-3 mb-5">
                    <label for="gender" class="text-xs font-semibold px-1">{{ __('Gender') }}</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                        <select class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" id="gender" name="gender" required>
                            <option value="boy">{{ __('Boy') }}</option>
                            <option value="girl">{{ __('Girl') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex -mx-3">
                <div class="w-full px-3 mb-10">
                    <label for="description" class="text-xs font-semibold px-1">{{ __('Description') }}</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                        <textarea class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:blue-indigo-500" id="description" type="text" name="description" placeholder="{{ __('Write something') }}..." required></textarea>
                    </div>
                </div>
            </div>
            <div class="flex -mx-3">
                <div class="w-full px-3 mb-5">
                    <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-blue-700 text-white rounded-lg px-3 py-3 font-semibold">{{ __('Create list') }}</button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>

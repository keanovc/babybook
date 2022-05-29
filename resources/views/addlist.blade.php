<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg">
            <div class="flex">
                <div class="flex-1 group">
                    <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-indigo-500 group-hover:text-indigo-500">
                        <span class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                list_alt
                            </span>
                            <span class="block text-xs pb-2">Lists</span>
                            <span class="block w-5 mx-auto h-1 bg-indigo-500 group-hover:bg-indigo-500 rounded-full"></span>
                        </span>
                    </a>
                </div>
                <div class="flex-1 group">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button onclick="event.preventDefault(); this.closest('form').submit();" type="button" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                            <span class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined">
                                    logout
                                </span>
                                <span class="block text-xs pb-2">Logout</span>
                                <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="w-10/12 mx-auto mt-10 text-[#1E3A4C]">
        <div class="flex items-center justify-between mb-5 px-1">
            <h1 class="text-xl uppercase font-bold">Create list</h1>
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
                    <label for="name" class="text-xs font-semibold px-1">Name</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                        <input type="text" id="name" name="name" class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="John Doe" required>
                    </div>
                </div>
            </div>
            <div class="flex -mx-3">
                <div class="w-full px-3 mb-5">
                    <label for="gender" class="text-xs font-semibold px-1">Gender</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                        <select class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" id="gender" name="gender" required>
                            <option value="boy">Boy</option>
                            <option value="girl">Girl</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex -mx-3">
                <div class="w-full px-3 mb-5">
                    <label for="description" class="text-xs font-semibold px-1">Description</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                        <textarea class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:blue-indigo-500" id="description" type="text" name="description" placeholder="Write something..." required></textarea>
                    </div>
                </div>
            </div>
            <div class="flex -mx-3 mb-10">
                <div class="w-full px-3">
                    <label for="" class="text-xs font-semibold px-1">Invitation Code</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                        <input type="text" id="invite" name="invite" class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:blue-indigo-500" placeholder="4258" required>
                    </div>
                </div>
            </div>
            <div class="flex -mx-3">
                <div class="w-full px-3 mb-5">
                    <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-blue-700 text-white rounded-lg px-3 py-3 font-semibold">{{ __('Create List') }}</button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>

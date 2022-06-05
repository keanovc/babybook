<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg md:flex md:justify-around md:items-center">
            <a href="{{ route('dashboard') }}" class="hidden md:block">
                <img class="h-8 w-auto" src="../../img/logob.svg" alt="logo">
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

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
            <div class="z-10 absolute top-24 left-1/2 transform -translate-x-1/2 text-[#1E3A4C] md:w-4/12 w-11/12">
                <div class="shadow-lg bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full" role="alert">
                    <span class="material-symbols-outlined mr-2">
                        error
                    </span>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @elseif (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
            <div class="z-10 absolute top-24 left-1/2 transform -translate-x-1/2 text-[#1E3A4C] md:w-4/12 w-11/12">
                <div class="shadow-lg bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full" role="alert">
                    <span class="material-symbols-outlined mr-2">
                        check_circle
                    </span>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <div class="copied hidden">
        <div class="z-10 absolute top-24 left-1/2 transform -translate-x-1/2 text-[#1E3A4C] w-11/12 md:w-4/12 border-green-700">
            <div class="shadow-lg bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full" role="alert">
                <span class="material-symbols-outlined mr-2">
                    check_circle
                </span>
                {{ __('Invite link copied!') }}
            </div>
        </div>
    </div>

    <div class="pt-10 text-[#1E3A4C]">
        <div class="w-10/12 max-w-sm mx-auto">
            <a href="{{ route('addlist') }}" class="flex justify-center items-center bg-white rounded-3xl overflow-hidden h-24 lg:h-32 border shadow-md transition duration-500 hover:scale-105">
                <p class="text-grey-darker text-lg font-bold">+ {{ __('add birth list') }}</p>
            </a>
        </div>
    </div>

    <div class="container mx-auto grid gap-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1">
        @foreach ($lists as $list)
            <div class="mt-5 py-5 bg-white font-semibold text-center rounded-3xl border shadow-lg mx-auto w-10/12 md:w-11/12">
                <img class="mb-3 w-32 h-32 rounded-full shadow-lg mx-auto" src="https://t3.ftcdn.net/jpg/01/28/56/34/360_F_128563455_bGrVZnfDCL0PxH1sU33NpOhGcCc1M7qo.jpg" alt="baby">
                <h1 class="text-xl text-gray-700"> {{ $list->name }} </h1>
                <h3 class="text-sm text-gray-400 "> {{ $list->description }} </h3>
                <button class="btn flex items-center mx-auto mt-5 transition duration-500 hover:scale-105 bg-indigo-600 hover:bg-indigo-800 px-4 py-2 text-gray-100 rounded-full" data-clipboard-text='http://babybook.keanovancuyck.be/invitation/list?invitation_code={{$list->invitation_code}}'>
                    <span class="material-symbols-outlined mr-2">
                        content_copy
                    </span>
                    <p>{{ __('invite link') }}</p>
                </button>
                <div class="py-5 flex justify-center items-center">
                    <a href="{{ route('items', $list) }}" class="bg-indigo-600 transition duration-500 hover:scale-105 hover:bg-indigo-800 px-4 py-2 mx-2 rounded-3xl text-gray-100 font-semibold uppercase tracking-wide flex items-center justify-center">
                        <span class="material-symbols-outlined">
                            visibility
                        </span>
                    </a>
                    <form method="GET" action="{{ route('items.pdf', $list) }}">
                        <button type="submit" class="bg-indigo-900 hover:bg-indigo-800 transition duration-500 hover:scale-105 px-4 py-2 mx-2 rounded-3xl text-gray-100 font-semibold uppercase tracking-wide flex items-center justify-center">
                            <span class="material-symbols-outlined">
                                file_download
                            </span>
                        </button>
                    </form>
                    <form action="{{ route('dashboard.delete', $list) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="bg-red-600 hover:bg-red-800 px-4 py-2 mx-2 transition duration-500 hover:scale-105 rounded-3xl text-gray-100 font-semibold uppercase tracking-wide flex items-center justify-center">
                            <span class="material-symbols-outlined">
                                delete
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-guest-layout>

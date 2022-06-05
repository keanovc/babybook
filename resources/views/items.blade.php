<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg md:flex md:justify-around md:items-center">
            <a href="{{ route('dashboard') }}" class="hidden md:block">
                <img class="h-8 w-auto" src="../../img/logob.svg" alt="logo">
            </a>
            <div class="flex">
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <a href="{{ route('dashboard') }}" class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                list_alt
                            </span>
                            <span class="block text-xs pb-2">{{ __('Lists') }}</span>
                            <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                        </a>
                    </div>
                </div>
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-indigo-500 group-hover:text-indigo-500">
                        <a href="{{ route('items', $list) }}" class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                article
                            </span>
                            <span class="block text-xs pb-2">{{ __('Articles') }}</span>
                            <span class="block w-5 mx-auto h-1 bg-indigo-500 group-hover:bg-indigo-500 rounded-full"></span>
                        </a>
                    </div>
                </div>
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <a href="{{ route('orders', $list) }}" class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                redeem
                            </span>
                            <span class="block text-xs pb-2">{{ __('Orders') }}</span>
                            <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                        </a>
                    </div>
                </div>
                <div class="flex-1 group">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <div type="button" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                            <button onclick="event.preventDefault(); this.closest('form').submit();" class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined">
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

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
            <div class="z-10 absolute top-24 left-1/2 transform -translate-x-1/2 text-[#1E3A4C] md:w-4/12 w-11/12">
                <div class="shadow-lg bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full" role="alert">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @elseif (session('error'))
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
    @endif

    <div class="pt-10 text-[#1E3A4C]">
        <div class="w-full"><div class="w-10/12 max-w-sm mx-auto">
            <a href="{{ route('additems', $list) }}" class="flex justify-center items-center bg-white rounded-3xl overflow-hidden h-24 lg:h-32 border shadow-lg transition duration-500 hover:scale-105">
                <p class="text-grey-darker text-lg font-bold">+ {{ __('add articles') }}</p>
            </a>
        </div></div>
        <div class="container mx-auto grid gap-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1">
            @foreach ($reservedArticles as $reservedArticle)
                <div class="bg-white mx-auto w-10/12 md:w-11/12 rounded-3xl overflow-hidden mt-5 border shadow-lg">
                    <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../img/{{ $reservedArticle->image }}')">
                        <div class="flex items-center justify-center h-full w-full bg-gray-900 opacity-75">
                            <p class="text-white text-center text-2xl font-bold">{{ __('reserved') }}</p>
                        </div>
                    </div>
                    <div class="px-5 py-3">
                        <h1 class="text-lg font-normal mb-0 text-gray-600 font-sans">
                            {{ $reservedArticle->title }}
                        </h1>
                        <a href="{{ $reservedArticle->url }}" target="_blank">
                            <span class="text-sm text-indigo-300 hover:text-indigo-500 mt-0">{{ __('see article') }}</span>
                        </a>
                        <h1 class="mt-5 font-bold text-gray-500">€{{ $reservedArticle->price }}</h1>
                    </div>
                </div>
            @endforeach
            @foreach ($articles as $article)
                <div class="bg-white mx-auto w-10/12 md:w-11/12 rounded-3xl overflow-hidden mt-5 border shadow-lg">
                    <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../img/{{ $article->image }}')">
                        <form action="{{ route('items.delete', [$list, $article]) }}" method="POST">
                            @csrf

                            <button type="submit" class="flex px-2 py-2 rounded-full bg-red-500 transition duration-500 hover:scale-105 text-white mx-5 -mb-4 hover:bg-red-700 focus:outline-none focus:bg-blue-500">
                                <span class="material-symbols-outlined">
                                    close
                                </span>
                            </button>
                        </form>
                    </div>
                    <div class="px-5 py-3">
                        <h1 class="text-lg font-normal mb-0 text-gray-600 font-sans">
                            {{ $article->title }}
                        </h1>
                        <a href="{{ $article->url }}" target="_blank">
                            <span class="text-sm text-indigo-300 hover:text-indigo-500 mt-0">{{ __('see article') }}</span>
                        </a>
                        <h1 class="mt-5 font-bold text-gray-500">€{{ $article->price }}</h1>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>

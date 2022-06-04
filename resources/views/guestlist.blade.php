<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg md:flex md:justify-around md:items-center">
            <a href="{{ route('dashboard') }}" class="hidden md:block">
                <img class="h-8 w-auto" src="../../img/logob.svg" alt="logo">
            </a>
            <div class="flex">
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-indigo-500 group-hover:text-indigo-500">
                        <form method="GET" action="{{ route('guestlist') }}">
                            <input type="hidden" name="invitation_code" value="{{ $invitationCode }}">
                            <button type="submit" class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined">
                                    list_alt
                                </span>
                                <span class="block text-xs pb-2">{{ __('Articles') }}</span>
                                <span class="block w-5 mx-auto h-1 bg-indigo-500 group-hover:bg-indigo-500 rounded-full"></span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-500 group-hover:text-indigo-500">
                        <form method="GET" action="{{ route('cart') }}">
                            <input type="hidden" name="list" value="{{ $list->id }}">
                            <button type="submit" class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined">
                                    shopping_cart
                                </span>
                                <span class="block text-xs pb-2">{{ __('Cart') }}</span>
                                <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-500 group-hover:text-indigo-500">
                        <a href="{{ route('invitation') }}" class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                logout
                            </span>
                            <span class="block text-xs pb-2">{{ __('Logout') }}</span>
                            <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="pt-10 pb-5">
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
                <div class="z-10 absolute top-24 left-1/2 transform -translate-x-1/2 text-[#1E3A4C] md:w-4/12 w-11/12">
                    <div class="shadow-lg bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full" role="alert">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <main class="my-8">
            <div class="w-full mx-auto">
                <div class="mt-5 text-[#1E3A4C]">
                    <div class="w-10/12 max-w-sm mx-auto">
                        <div class="flex items-center justify-between {{ $list->gender === 'boy' ? 'bg-indigo-300' : 'bg-[#F3C2C2]' }} rounded-[12px] overflow-hidden h-24 lg:h-32">
                            <div class="flex items-center">
                                <div class="object-cover w-16 h-16 mx-5">
                                    <img class="rounded-full" src="https://t3.ftcdn.net/jpg/01/28/56/34/360_F_128563455_bGrVZnfDCL0PxH1sU33NpOhGcCc1M7qo.jpg" alt="baby">
                                </div>
                                <div class="text-left">
                                    <p class="text-grey-darker text-lg font-bold uppercase">{{ $list->name }}</p>
                                    <p class="text-grey-darker text-lg">{{ $list->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-10/12 md:w-7/12 mx-auto mt-10">
                    <h3>{{ __('Products') }} ({{ $articles->count() }})</h3>
                    <hr class="border-gray-400">
                </div>
                <div class="container mx-auto grid gap-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1">
                    @foreach ($articles as $article)
                        <div class="bg-white mx-auto w-10/12 md:w-11/12 rounded-3xl overflow-hidden mt-5 border shadow-lg">
                            <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../img/{{ $article->image }}')">
                                <form method="POST" action="{{ route('cartitem') }}">
                                    @csrf

                                    <input type="hidden" name="article" value="{{ $article->id }}">
                                    <input type="hidden" name="list" value="{{ $list->id }}">
                                    <button type="submit" class="{{ $cartItems->contains('id', $article->id) ? 'hidden' : '' }} flex px-2 py-2 rounded-full bg-indigo-500 transition duration-500 hover:scale-105 text-white mx-5 -mb-4 hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                                        <span class="material-symbols-outlined">
                                            add_shopping_cart
                                        </span>
                                    </button>
                                </form>
                            </div>
                            <div class="px-5 pb-3 pt-5">
                                <h1 class="text-lg font-normal mb-0 text-gray-600 font-sans">
                                    {{ $article->title }}
                                </h1>
                                <a href="{{ $article->url }}" target="_blank">
                                    <span class="text-sm text-indigo-300 hover:text-indigo-500 mt-0">{{ __('see article') }}</span>
                                </a>
                                <div class="flex items-center justify-between mt-5">
                                    <h1 class="font-bold text-gray-500">€{{ $article->price }}</h1>
                                    @if ($cartItems->contains('id', $article->id))
                                        <span class="bg-indigo-500 text-white ml-2 py-1 px-3 rounded-full">{{ __('Already added') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</x-guest-layout>

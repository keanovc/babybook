<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg md:flex md:justify-around md:items-center">
            <a href="{{ route('dashboard') }}" class="hidden md:block">
                <img class="h-8 w-auto" src="../../../img/logob.svg" alt="logo">
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
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-500 group-hover:text-indigo-500">
                        <a href="{{ route('items', $list) }}" class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                article
                            </span>
                            <span class="block text-xs pb-2">{{ __('Articles') }}</span>
                            <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                        </a>
                    </div>
                </div>
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-indigo-500 group-hover:text-indigo-500">
                        <a href="{{ route('orders', $list) }}" class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                redeem
                            </span>
                            <span class="block text-xs pb-2">{{ __('Orders') }}</span>
                            <span class="block w-5 mx-auto h-1 bg-indigo-500 group-hover:bg-indigo-500 rounded-full"></span>
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

    <div class="mx-auto w-10/12 md:w-6/12 lg:w-4/12 xl:w-4/12 bg-white rounded-3xl py-5 md:p-10 md:shadow-md mt-10 md:mt-20">
        <div class="flex justify-end mr-5">
            <a href="{{ route('orders', $list) }}" class="transition duration-500 hover:scale-110">
                <span class="material-symbols-outlined text-[#1E3A4C]">
                    close
                </span>
            </a>
        </div>

        <div class="pt-5 text-[#1E3A4C] w-10/12 mx-auto">
            <div class="flex items-center">
                <div class="text-left">
                    <p class="text-grey-darker text-lg font-bold uppercase">{{ __('Name') }}: {{ $order->name }}</p>
                    <p class="text-grey-darker text-lg">{{ __('Message') }}: {{ $order->remarks }}</p>
                    <p class="text-grey-darker text-lg">{{ __('Price') }}: {{ $order->total }}</p>
                    <p class="text-grey-darker text-lg">{{ __('Status') }}: {{ $order->status }}</p>
                </div>
            </div>
        </div>

        <div class="w-10/12 mx-auto max-w-sm mt-10">
            <h3>{{ __('Paid products') }} ({{ $articles->count() }})</h3>
            <hr class="border-gray-400">
        </div>

        <div class="mt-5 text-[#1E3A4C]">
            @if (count($articles) > 0)
                @foreach ($articles as $article)
                    <div class="bg-white w-10/12 max-w-sm mx-auto rounded-3xl overflow-hidden mt-5 border shadow-lg">
                        <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../../img/{{ $article->image }}')"></div>
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
            @else
                <div class="w-10/12 mx-auto max-w-sm">
                    <p class="text-center text-gray-500">{{ __('No products yet') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>

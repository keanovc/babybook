<x-guest-layout>
    <div class="pt-16">
        <x-slot name="header">
            <div class="px-7 bg-white shadow-lg">
                <div class="flex">
                    <div class="flex-1 group">
                        <a href="{{ route('dashboard') }}" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                            <span class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined">
                                    list_alt
                                </span>
                                <span class="block text-xs pb-2">Lists</span>
                                <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                            </span>
                        </a>
                    </div>
                    <div class="flex-1 group">
                        <a href="{{ route('items', $list) }}" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                            <span class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined">
                                    article
                                </span>
                                <span class="block text-xs pb-2">Articles</span>
                                <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                            </span>
                        </a>
                    </div>
                    <div class="flex-1 group">
                        <a href="{{ route('orders', $list) }}" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-indigo-500 group-hover:text-indigo-500">
                            <span class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined">
                                    redeem
                                </span>
                                <span class="block text-xs pb-2">Orders</span>
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

        <div class="bg-white mt-10 py-5 px-2 border shadow-lg w-10/12 lg:w-2/12 mx-auto rounded-lg">
            <a href="{{ route('orders', $list) }}" class="flex justify-end mr-5">
                <span class="material-symbols-outlined text-[#1E3A4C]">
                    close
                </span>
            </a>

            <div class="pt-5 text-[#1E3A4C] w-10/12 lg:w-2/12 mx-auto">
                <div class="flex items-center">
                    <div class="text-left">
                        <p class="text-grey-darker text-lg font-bold uppercase">Naam: {{ $order->name }}</p>
                        <p class="text-grey-darker text-lg">Bericht: {{ $order->remarks }}</p>
                        <p class="text-grey-darker text-lg">Prijs: {{ $order->total }}</p>
                        <p class="text-grey-darker text-lg">Status: {{ $order->status }}</p>
                    </div>
                </div>
            </div>

            <div class="w-10/12 mx-auto max-w-sm mt-10">
                <h3>Paid products ({{ $articles->count() }})</h3>
                <hr class="border-gray-400">
            </div>

            <div class="mt-5 text-[#1E3A4C]">
                @if (count($articles) > 0)
                    @foreach ($articles as $article)
                        <div class="w-10/12 max-w-sm mx-auto rounded-[12px] overflow-hidden mt-5 border shadow-lg">
                            <div class="flex items-end justify-end h-36 w-full bg-cover" style="background-image: url('../../../img/{{ $article->image }}')"></div>
                            <div class="px-5 py-3">
                                <h3 class="text-gray-700 uppercase">{{ $article->title }}</h3>
                                <span class="text-gray-500 mt-2">€{{ $article->price }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-gray-500">No items yet</p>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>

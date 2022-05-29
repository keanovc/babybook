<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg rounded-t-2xl">
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

    @foreach ($orders as $order)
        <div class="pt-5 text-[#1E3A4C] w-11/12 lg:w-2/12 mx-auto">
            <a href="{{ route('orders.reserved', [$list, $order->id]) }}" class="flex items-center justify-between bg-white rounded-[12px] overflow-hidden h-32 lg:h-32 border shadow-md">
                <div class="flex items-center pr-16">
                    <div class="w-16 h-16 mx-5 flex object-cover">
                        <img class="rounded-full" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Placeholder_no_text.svg/1200px-Placeholder_no_text.svg.png" alt="person">
                    </div>
                    <div class="text-left">
                        <p class="text-grey-darker text-lg font-bold uppercase">{{ $order->name }}</p>
                        <p class="text-grey-darker text-lg">Prijs: {{ $order->total }}</p>
                        <p class="text-grey-darker text-lg">Status: {{ $order->status }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</x-guest-layout>

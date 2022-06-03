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
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
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

    <div class="pt-10 mx-auto w-11/12 max-w-sm">
        @if (count($orders) > 0)
            @foreach ($orders as $order)
                @if ($order->status == 'pending')
                <div class="pl-1 h-20 bg-yellow-400 mb-5 rounded-lg shadow-md transition duration-500 hover:scale-105">
                    <a href="{{ route('orders.reserved', [$list, $order->id]) }}" class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                        <div class="my-auto">
                            <p class="font-bold">{{ $order->name }} ({{ __('PENDING') }})</p>
                            <p class="text-lg">€{{ $order->total }}</p>
                        </div>
                        <div class="my-auto">
                            <span class="material-symbols-outlined">
                                person
                            </span>
                        </div>
                    </a>
                </div>
                @else
                <div class="pl-1 h-20 bg-green-400 mb-5 rounded-lg shadow-md transition duration-500 hover:scale-105">
                    <a href="{{ route('orders.reserved', [$list, $order->id]) }}" class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                        <div class="my-auto">
                            <p class="font-bold">{{ $order->name }} ({{ __('PAID') }})</p>
                            <p class="text-lg">€{{ $order->total }}</p>
                        </div>
                        <div class="my-auto">
                            <span class="material-symbols-outlined">
                                person
                            </span>
                        </div>
                    </a>
                </div>
                @endif
            @endforeach
        @else
            <div class="pl-1 h-20 bg-red-400 mb-5 rounded-lg shadow-md">
                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                <div class="my-auto">
                    <p class="font-bold">{{ __('No orders') }}</p>
                </div>
                </div>
            </div>
        @endif
    </div>
</x-guest-layout>

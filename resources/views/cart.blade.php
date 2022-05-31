<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg md:flex md:justify-around md:items-center">
            <a href="{{ route('dashboard') }}" class="hidden md:block">
                <img class="h-8 w-auto" src="../../img/logob.svg" alt="logo">
            </a>
            <div class="flex">
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-500 group-hover:text-indigo-500">
                        <form method="GET" action="{{ route('guestlist') }}">
                            <input type="hidden" name="invitation_code" value="{{ $invitationCode }}">
                            <button type="submit" class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined">
                                    list_alt
                                </span>
                                <span class="block text-xs pb-2">{{ __('Articles') }}</span>
                                <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-indigo-500 group-hover:text-indigo-500">
                        <form method="GET" action="{{ route('cart') }}">
                            <input type="hidden" name="list" value="{{ $list->id }}">
                            <button type="submit" class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined">
                                    shopping_cart
                                </span>
                                <span class="block text-xs pb-2">{{ __('Cart') }}</span>
                                <span class="block w-5 mx-auto h-1 bg-indigo-500 group-hover:bg-indigo-500 rounded-full"></span>
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
        <main class="mx-auto w-10/12 md:w-6/12 lg:w-4/12 xl:w-4/12 md:p-10">
            @foreach ($cart->getContent() as $item)
                <div class="flex items-start pt-8 pb-8">
                    <img
                    class="object-cover w-24 h-24 rounded-lg"
                    src="../../img/{{ $item->attributes->image }}"
                    alt="{{ $item->name }}"
                    />

                    <div class="ml-4">
                    <h3 class="text-sm">{{ $item->name }}</h3>

                    <dl class="mt-1 space-y-1 text-xs text-gray-500">
                        <div>
                        <dt class="inline">{{ __('Price') }}:</dt>
                        <dd class="inline">€{{ $item->price }}</dd>
                        </div>
                    </dl>
                    <dl class="mt-3 space-y-1 text-xs text-gray-500">
                        <div>
                            <form method="POST" action="{{ route('cart.delete', $item->id) }}">
                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="list" value="{{ $list->id }}">
                                <button type="submit" class="text-gray-500 focus:outline-none focus:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            </form>
                        </div>
                    </dl>
                    </div>
                </div>
            @endforeach
            @if ($cart->isEmpty())
                <div class="text-center">
                    <h3 class="text-gray-500">{{ __('Your cart is empty') }}</h3>
                </div>
            @else
                <hr class="my-5 border-gray-400">
                <dl class="flex justify-end mb-5 space-y-1 text-lg text-gray-500">
                    <div>
                    <dt class="inline">{{ __('Total') }}:</dt>
                        <dd class="inline">€{{ $cart->getTotal() }}</dd>
                    </div>
                </dl>
                <div class="space-y-4 text-center md:w-6/12 md:mx-auto md:mt-20">
                    <form action="{{ route('checkout') }}" method="GET">
                        <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Name') }}" required>
                        <textarea id="remarks" name="remarks" rows="4" class="block mt-3 mb-6 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="{{ __('Message for the parents') }}..." required></textarea>
                        <input type="hidden" name="list" value="{{ $list->id }}">
                        <button class="block w-full p-3 text-sm rounded-lg bg-blue-500 text-stone-100 hover:bg-stone-500" type="submit">
                            {{ __('Check out') }}
                        </button>
                    </form>

                    <form action="{{ route('guestlist') }}" method="GET">
                        <input type="hidden" name="invitation_code" value="{{ $invitationCode }}">
                        <button type="submit" class="inline-block text-sm tracking-wide underline underline-offset-4 text-stone-500 hover:text-stone-600">
                            {{ __('Continue shopping') }}
                        </button>
                    </form>
                </div>
            @endif
        </main>
    </div>
</x-guest-layout>

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
                <div class="space-y-4 md:w-8/12 md:mx-auto md:mt-20">
                    <form action="{{ route('checkout') }}" method="GET">
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
                            <div class="w-full px-3 mb-10">
                                <label for="description" class="text-xs font-semibold px-1">{{ __('Message') }}</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                    <textarea class="w-full -ml-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:blue-indigo-500" id="remarks" type="text" name="remarks" placeholder="{{ __('Message for the parents') }}..." required></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="list" value="{{ $list->id }}">
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 transition duration-500 hover:scale-105 text-white rounded-lg px-3 py-3 font-semibold">{{ __('Check out') }}</button>
                            </div>
                        </div>
                    </form>

                    <form class="text-center" action="{{ route('guestlist') }}" method="GET">
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

<x-app-layout>
    <svg class="lg:hidden" width="390" height="74" viewBox="0 0 390 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M179.5 46C132.364 36.2406 -8.50609 29.3876 -55 23.5L-28.5047 -25H458.932C462.264 12.0698 376.496 70.4066 344.5 72.5C304.505 75.1167 293 69.5 179.5 46Z" fill="#9EC4C5"/>
        <path d="M219.429 -15.1767C98.7047 -7.31814 3.5079 25.5488 -29 41L1.79696 -25H203.004C258.78 -25 340.153 -23.0353 219.429 -15.1767Z" fill="#F3C2C2"/>
    </svg>

    <div x-data="{ cartOpen: false }">
        <header>
            <div class="w-10/12 mx-auto pt-6">
                <div class="flex items-center justify-between">
                    <div class="w-full text-gray-700 md:text-center text-2xl font-semibold flex items-center">
                        CART ({{ $cart->getContent()->count() }})
                    </div>
                </div>
            </div>
        </header>
    </div>

    <hr class="w-11/12 mt-2 mx-auto border-[#1E3A4C]">

    <main class="my-8">
        <div class="w-10/12 mx-auto">
            <div class="mt-10 text-[#1E3A4C]">
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
                              <dt class="inline">Prijs:</dt>
                              <dd class="inline">€{{ $item->price }}</dd>
                            </div>
                          </dl>
                          <dl class="mt-1 space-y-1 text-xs text-gray-500">
                            <div>
                                <form method="DELETE" action="{{ route('cart.delete', $item->id) }}">
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
                        <h3 class="text-gray-500">Your cart is empty</h3>
                    </div>
                @else
                    <hr class="my-5 border-gray-400">
                    <dl class="flex justify-end mb-5 space-y-1 text-lg text-gray-500">
                        <div>
                          <dt class="inline">Totaal:</dt>
                            <dd class="inline">€{{ $cart->getTotal() }}</dd>
                        </div>
                      </dl>
                    <div class="space-y-4 text-center">
                        <form action="{{ route('checkout') }}" method="GET">
                            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Name" required>
                            <textarea id="remarks" name="remarks" rows="4" class="block mt-3 mb-6 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Message for the parents..." required></textarea>
                            <input type="hidden" name="list" value="{{ $list->id }}">
                            <button class="block w-full p-3 text-sm rounded-lg bg-blue-500 text-stone-100 hover:bg-stone-500" type="submit">
                                Check out
                            </button>
                        </form>

                        <form action="{{ route('guestlist') }}" method="GET">
                            <input type="hidden" name="invitation_code" value="{{ $invitationCode }}">
                            <button type="submit" class="inline-block text-sm tracking-wide underline underline-offset-4 text-stone-500 hover:text-stone-600">
                                Continue shopping
                            </button>
                        </form>

                    </div>
                @endif
            </div>
        </div>
    </main>
</x-app-layout>

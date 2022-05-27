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
                        LIST
                    </div>
                    <div class="flex items-center justify-end w-full">
                        <form method="GET" action="{{ route('cart') }}">
                            <input type="hidden" name="list" value="{{ $list->id }}">
                            <button type="submit" class="text-gray-600 focus:outline-none sm:mx-0">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </header>
    </div>

    <hr class="w-11/12 mt-2 mx-auto border-[#1E3A4C]">

    <main class="my-8">
        <div class="w-10/12 mx-auto">
            <div class="mt-5 text-[#1E3A4C]">
                <div class="w-11/12 lg:w-2/12 mx-auto">
                    <div class="flex items-center justify-between bg-[#9EC4C5] rounded-[12px] overflow-hidden h-24 lg:h-32 border shadow-md">
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
            <div class="w-11/12 mx-auto max-w-sm mt-10">
                <h3>Products ({{ $articles->count() }})</h3>
                <hr class="border-gray-400">
            </div>
            <div class="mt-5 text-[#1E3A4C]">
                @foreach ($articles as $article)
                    <div class="w-11/12 max-w-sm mx-auto rounded-[12px] overflow-hidden mt-5 border shadow-lg">
                        <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../img/{{ $article->image }}')">
                            <form method="POST" action="{{ route('cartitem') }}">
                                @csrf

                                <input type="hidden" name="article" value="{{ $article->id }}">
                                <input type="hidden" name="list" value="{{ $list->id }}">
                                <button type="submit" class="{{ $cartItems->contains('id', $article->id) ? 'hidden' : '' }} p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </button>
                            </form>
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">{{ $article->title }}</h3>
                            <span class="text-gray-500 mt-2">€{{ $article->price }}</span>
                            @if ($cartItems->contains('id', $article->id))
                                <span class="text-red-500 ml-2">Already added</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</x-app-layout>

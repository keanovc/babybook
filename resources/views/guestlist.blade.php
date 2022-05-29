<x-guest-layout>
    <x-slot name="header">
        <div class="w-full text-gray-700 md:text-center text-2xl font-semibold flex items-center">
            LIST
        </div>
        <div class="flex items-center justify-end w-full">
            <form method="GET" action="{{ route('cart') }}">
                <input type="hidden" name="list" value="{{ $list->id }}">
                <button type="submit" class="text-white bg-gray-700 hover:bg-gray-900 focus:ring-gray-300 font-medium rounded-md text-sm ml-2 px-2 pt-1">
                    <span class="material-symbols-outlined">
                        shopping_cart
                    </span>
                </button>
            </form>

        </div>
    </x-slot>

    <hr class="w-11/12 mt-2 mx-auto border-[#1E3A4C]">

    <main class="my-8">
        <div class="w-10/12 mx-auto">
            <div class="mt-5 text-[#1E3A4C]">
                <div class="w-11/12 lg:w-2/12 mx-auto">
                    <div class="flex items-center justify-between {{ $list->gender === 'boy' ? 'bg-[#9EC4C5]' : 'bg-[#F3C2C2]' }} rounded-[12px] overflow-hidden h-24 lg:h-32 border shadow-md">
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
                                <button type="submit" class="{{ $cartItems->contains('id', $article->id) ? 'hidden' : '' }} flex px-2 py-2 rounded-full bg-blue-500 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                    <span class="material-symbols-outlined">
                                        add_shopping_cart
                                    </span>
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
</x-guest-layout>

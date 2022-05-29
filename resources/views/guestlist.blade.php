<x-cart-layout>
    <div class="pt-10 pb-5">
        <div class="w-10/12 mx-auto">
            <div class="flex items-center justify-between mb-5 px-1">
                <h1 class="text-xl uppercase font-bold">Birthlist</h1>
                <form method="GET" action="{{ route('cart') }}">
                    <input type="hidden" name="list" value="{{ $list->id }}">
                    <button type="submit" class="text-black focus:ring-gray-300 font-medium rounded-md text-sm">
                        <span class="material-symbols-outlined">
                            shopping_cart
                        </span>
                    </button>
                </form>
            </div>

            <hr class="my-5 mx-auto border-[#1E3A4C]">
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
                <div class="z-10 absolute top-10 left-1/2 transform -translate-x-1/2 text-[#1E3A4C] w-10/12">
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
            <div class="w-10/12 mx-auto">
                <div class="mt-5 text-[#1E3A4C]">
                    <div class="w-full lg:w-2/12 mx-auto">
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
                <div class="w-full mx-auto max-w-sm mt-10">
                    <h3>Products ({{ $articles->count() }})</h3>
                    <hr class="border-gray-400">
                </div>
                <div class="mt-5 text-[#1E3A4C] ">
                    @foreach ($articles as $article)
                        <div class="bg-indigo-50 w-full max-w-sm mx-auto rounded-[12px] overflow-hidden mt-5 border shadow-lg">
                            <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../img/{{ $article->image }}')">
                                <form method="POST" action="{{ route('cartitem') }}">
                                    @csrf

                                    <input type="hidden" name="article" value="{{ $article->id }}">
                                    <input type="hidden" name="list" value="{{ $list->id }}">
                                    <button type="submit" class="{{ $cartItems->contains('id', $article->id) ? 'hidden' : '' }} flex px-2 py-2 rounded-full bg-indigo-500 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
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
                                    <span class="text-sm text-indigo-300 mt-0">see article</span>
                                </a>
                                <div class="flex items-center justify-between mt-5">
                                    <h1 class="font-bold text-gray-500">€{{ $article->price }}</h1>
                                    @if ($cartItems->contains('id', $article->id))
                                        <span class="bg-indigo-500 text-white ml-2 py-1 px-3 rounded-full">Already added</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</x-cart-layout>

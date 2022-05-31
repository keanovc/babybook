<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg md:flex md:justify-around md:items-center">
            <a href="{{ route('dashboard') }}" class="hidden md:block">
                <img class="h-8 w-auto" src="../../img/logob.svg" alt="">
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
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-indigo-500 group-hover:text-indigo-500">
                        <a href="{{ route('items', $list) }}" class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                article
                            </span>
                            <span class="block text-xs pb-2">{{ __('Articles') }}</span>
                            <span class="block w-5 mx-auto h-1 bg-indigo-500 group-hover:bg-indigo-500 rounded-full"></span>
                        </a>
                    </div>
                </div>
                <div class="flex-1 group">
                    <div class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <a href="{{ route('orders', $list) }}" class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                redeem
                            </span>
                            <span class="block text-xs pb-2">{{ __('Orders') }}</span>
                            <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
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

    <div class="mt-10 mx-auto w-10/12 md:w-6/12 lg:w-4/12 xl:w-4/12 md:bg-white md:rounded-3xl md:p-10 md:shadow-md md:mt-20">
        <div class="flex items-center justify-between mb-5 px-1">
            <h1 class="text-xl uppercase font-bold">{{ __('Add articles') }}</h1>
            <a href="{{ route('items', $list) }}" class="text-black focus:ring-gray-300 font-medium rounded-md text-sm">
                <span class="material-symbols-outlined">
                    close
                </span>
            </a>
        </div>
        <hr class="my-5 mx-auto border-[#1E3A4C]">
        <form action="{{ route('additems', $list) }}" method="GET">
            <div class="flex flex-wrap">
                <div class="w-full px-3">
                    <label class="block font-bold uppercase text-gray-700 tracking-wide mb-2">
                        {{ __('Category') }}
                    </label>
                    <select name="category" class="form-select appearance-none
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                        <option value="">{{ $currentCategoryTitle }} - {{ $currentCategoryShop }}</option>
                        @foreach ($categoriesWithArticles as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->title }} - {{ $category->shop }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex flex-wrap my-10">
                <div class="w-full px-3">
                    <div x-data="{ price:
                        @if (isset($currentPrice))
                            {{ $currentPrice }}
                        @else
                            {{ floor(($highestPrice + $lowestPrice) / 2) }}
                        @endif
                    }">
                        <label for="price" class="font-bold uppercase text-gray-700" x-text="`Price €` + price"></label>
                        <input type="range" min="{{ $lowestPrice }}" name="price" max="{{ $highestPrice }}" x-model="price"
                        class="w-full h-2 bg-indigo-200 appearance-none" />
                    </div>
                </div>
            </div>
            <div class="w-full px-3">
                <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-blue-700 text-white rounded-lg px-3 py-3 font-semibold">Search</button>
            </div>
        </form>
        <div class="w-full mx-auto mt-10">
            <h3>{{ __('Products') }} ({{ count($articlesWithPriceBelowHighest) }})</h3>
            <hr class="border-gray-400">
        </div>
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
                <div class="z-10 absolute top-24 left-1/2 transform -translate-x-1/2 text-[#1E3A4C] w-10/12">
                    <div class="shadow-lg bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full" role="alert">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                          <path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="w-full mx-auto md:overflow-y-auto md:h-[32rem]">
            @foreach ($articlesWithPriceBelowHighest as $article)
                <div class="bg-white w-full max-w-sm mx-auto my-5 rounded-3xl overflow-hidden mt-5 border shadow-lg">
                    <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../img/{{ $article->image }}')">
                        <form method="POST" action="{{ route('additems.store', $article) }}">
                            @csrf

                            <input type="hidden" name="list" value="{{ $list }}">
                            <input type="hidden" name="article" value="{{ $article->id }}">
                            <button type="submit" class="flex px-2 py-2 rounded-full bg-indigo-500 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                <span class="material-symbols-outlined">
                                    add
                                </span>
                            </button>
                        </form>
                    </div>
                    <div class="px-5 py-3">
                        <h1 class="text-lg font-normal mb-0 text-gray-600 font-sans">
                            {{ $article->title }}
                        </h1>
                        <a href="{{ $article->url }}" target="_blank">
                            <span class="text-sm text-indigo-300 mt-0">{{ __('see article') }}</span>
                        </a>
                        <h1 class="mt-5 font-bold text-gray-500">€{{ $article->price }}</h1>
                    </div>
                </div>
                <hr class="w-10/12 mx-auto border-gray-300">
            @endforeach
        </div>
    </div>
</x-guest-layout>

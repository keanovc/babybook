<x-guest-layout>
    <x-slot name="header">
        <h1 class="text-[#1E3A4C] font-bold text-2xl uppercase">ADD ITEMS</h1>
        <div class="flex items-center justify-around">
            <a href="{{ route('items', $list) }}" class="text-white bg-gray-700 hover:bg-gray-900 focus:ring-gray-300 font-medium rounded-md text-sm ml-2 px-2 pt-1">
                <span class="material-symbols-outlined">
                    close
                </span>
            </a>
        </div>
    </x-slot>

    <hr class="w-11/12 mt-2 mx-auto border-[#1E3A4C]">

    <div class="mt-10 mx-auto w-10/12 xl:w-3/12 lg:w-3/12 lg:bg-white lg:rounded lg:p-10 lg:shadow-md lg:mt-20">
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
            <div class="flex flex-wrap mt-10">
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
                        class="w-full h-2 bg-blue-100 appearance-none" />
                    </div>
                </div>
            </div>
            <button class="block w-11/12 mt-10 mx-auto p-3 text-sm rounded-lg bg-blue-500 text-stone-100 hover:bg-stone-500" type="submit">
                Search
            </button>
        </form>
        <hr class="w-11/12 mt-10 mx-auto border-[#1E3A4C]">
        @if (session('success'))
            <div class="mt-10 text-[#1E3A4C]">
                <div class="w-11/12 max-w-sm mx-auto">
                    <div class="flex justify-center items-center bg-green-200 border-green-300 rounded-[12px] overflow-hidden h-24 lg:h-32 border shadow-lg">
                        <p class="text-grey-darker text-lg font-bold">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="w-11/12 mx-auto">
            @foreach ($articlesWithPriceBelowHighest as $article)
                <div class="w-full max-w-sm mx-auto my-10 rounded-md shadow-md overflow-hidden">
                    <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../../img/{{ $article->image }}')">
                        <form method="POST" action="{{ route('additems.store', $article) }}">
                            @csrf

                            <input type="hidden" name="list" value="{{ $list }}">
                            <input type="hidden" name="article" value="{{ $article->id }}">
                            <button type="submit" class="flex px-2 py-2 rounded-full bg-blue-500 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                <span class="material-symbols-outlined">
                                    add
                                </span>
                            </button>
                        </form>
                    </div>
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{ $article->title }}</h3>
                        <span class="text-gray-500 mt-2">€ {{ $article->price }}</span>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</x-guest-layout>

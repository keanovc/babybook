<x-app-layout>
    <svg width="390" height="74" viewBox="0 0 390 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M179.5 46C132.364 36.2406 -8.50609 29.3876 -55 23.5L-28.5047 -25H458.932C462.264 12.0698 376.496 70.4066 344.5 72.5C304.505 75.1167 293 69.5 179.5 46Z" fill="#9EC4C5"/>
        <path d="M219.429 -15.1767C98.7047 -7.31814 3.5079 25.5488 -29 41L1.79696 -25H203.004C258.78 -25 340.153 -23.0353 219.429 -15.1767Z" fill="#F3C2C2"/>
    </svg>

    <header class="mt-6">
        <div class="flex justify-between items-center w-10/12 m-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-simpleline-logout onclick="event.preventDefault();
                this.closest('form').submit();" class="h-6 text-[#1E3A4C]"/>
            </form>
            <h1 class="text-[#1E3A4C] font-bold text-2xl uppercase">ADD ITEMS</h1>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <p class="text-3xl">x</p>
            </x-nav-link>
        </div>
    </header>

    <hr class="w-11/12 mt-2 mx-auto border-[#1E3A4C]">

    <div class="mt-10 mx-auto w-10/12 xl:w-3/12 lg:w-3/12 lg:bg-white lg:rounded lg:p-10 lg:shadow-md lg:mt-20">
        <div class="flex flex-wrap">
            <div class="w-full px-3">
            <label class="block font-bold uppercase text-gray-700 tracking-wide mb-2">
                {{ __('Category') }}
            </label>
            <form action="{{ route('additems') }}" method="GET">
                <select onchange="this.form.submit()" required name="category" class="form-select appearance-none
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
            </form>
            </div>
        </div>
        <div class="flex flex-wrap mt-10">
            <div class="w-full px-3">
                <form action="{{ route('additems') }}" method="GET">
                    <div x-data="{ price:
                        @if (isset($currentPrice))
                            {{ $currentPrice }}
                        @else
                            {{ floor(($highestPrice + $lowestPrice) / 2) }}
                        @endif
                    }">
                        <label for="price" class="font-bold uppercase text-gray-700" x-text="`Prijs €` + price"></label>
                        <input onchange="this.form.submit()" type="range" min="{{ $lowestPrice }}" name="price" max="{{ $highestPrice }}" x-model="price"
                          class="w-full h-2 bg-blue-100 appearance-none" />
                    </div>
                </form>
            </div>
        </div>
        <form action="{{ route('additems.store') }}" method="POST">
            @csrf
            {{-- <div class="flex flex-wrap mt-10">
                <div class="w-full px-3">
                    <label class="block font-bold uppercase text-gray-700 tracking-wide mb-2">
                        {{ __('Article') }}
                    </label>
                    <select required name="article" class="form-select appearance-none
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
                        @foreach ($articlesWithPriceBelowHighest as $article)
                            <img src="../../../img/{{ $article->image }}" alt="{{ $article->title }}">
                            <option value="{{ $article->id }}">{{ $article->title }} - € {{ $article->price }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}

            <div class="overflow-y-auto h-80 mt-10 w-11/12 mx-auto text-[#1E3A4C] bg-white border rounded-[12px]">
                @foreach ($articlesWithPriceBelowHighest as $article)
                    <div class="flex items-center">
                        <input class="form-check-input hidden peer appearance-none h-4 w-4 mx-3 border border-gray-300 accent-gray-600 rounded-full bg-white checked:bg-gray-600 checked:border-gray-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="" id="{{ $article->title }}">
                        <label for="{{ $article->title }}" class="peer-checked:bg-[#9EC4C5]">
                            <div class="flex justify-between ml-5 overflow-hidden h-auto lg:h-32">
                                <div class="flex items-center">
                                    <img class="block object-cover h-16 w-3/12 flex-none bg-cover" src="../../../img/{{ $article->image }}" alt="{{ $article->title }}">
                                    <div class="ml-2 rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                                        <div class="font-bold text-md mb-2 leading-tight">{{ $article->title }}</div>
                                        <p class="text-base">€ {{ $article->price }}</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    <hr>
                @endforeach
            </div>

            <div class="flex justify-center">
                <button class="bg-[#9EC4C5] absolute bottom-10 xl:relative xl:bottom-0 xl:mt-20 w-8/12 lg:w-6/12 text-white font-bold py-2 px-4 rounded" type="submit">
                    {{ __('Add Items') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

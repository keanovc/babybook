<x-app-layout>
    <svg width="390" height="74" viewBox="0 0 390 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M179.5 46C132.364 36.2406 -8.50609 29.3876 -55 23.5L-28.5047 -25H458.932C462.264 12.0698 376.496 70.4066 344.5 72.5C304.505 75.1167 293 69.5 179.5 46Z" fill="#9EC4C5"/>
        <path d="M219.429 -15.1767C98.7047 -7.31814 3.5079 25.5488 -29 41L1.79696 -25H203.004C258.78 -25 340.153 -23.0353 219.429 -15.1767Z" fill="#F3C2C2"/>
    </svg>

    <header class="mt-6">
        <div class="flex justify-between items-center w-10/12 m-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button onclick="event.preventDefault();
                this.closest('form').submit();" class="h-6 text-[#1E3A4C]"/> {{ __('LOGOUT') }} </button>
            </form>
            <h1 class="text-[#1E3A4C] font-bold text-2xl uppercase">ADD ITEMS</h1>
            <x-nav-link :href="route('items')" :active="request()->routeIs('dashboard')">
                Close
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
                        <label for="price" class="font-bold uppercase text-gray-700" x-text="`Price €` + price"></label>
                        <input onchange="this.form.submit()" type="range" min="{{ $lowestPrice }}" name="price" max="{{ $highestPrice }}" x-model="price"
                          class="w-full h-2 bg-blue-100 appearance-none" />
                    </div>
                </form>
            </div>
        </div>
        <form action="{{ route('additems.store', $list) }}" method="POST">
            @csrf

            <div class="w-11/12 mx-auto">
                @foreach ($articlesWithPriceBelowHighest as $article)
                    <form method="POST" action="{{ route('additems.store', $listId) }}">
                        <div class="w-full max-w-sm mx-auto my-10 rounded-md shadow-md overflow-hidden">
                            <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../../img/{{ $article->image }}')">
                                <button class="py-2 px-4 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500" type="submit">
                                    <p class="text-2xl">+</p>
                                </button>
                            </div>
                            <div class="px-5 py-3">
                                <h3 class="text-gray-700 uppercase">{{ $article->title }}</h3>
                                <span class="text-gray-500 mt-2">€ {{ $article->price }}</span>
                            </div>
                        </div>
                    </form>
                    <hr>
                @endforeach
            </div>
        </form>
    </div>
</x-app-layout>

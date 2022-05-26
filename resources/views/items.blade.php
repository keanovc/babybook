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
                this.closest('form').submit();" class="h-6 text-[#1E3A4C]"> {{ __('Logout') }} </button>
            </form>
            <h1 class="text-[#1E3A4C] font-bold text-2xl uppercase">Items</h1>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('reserved')">
                Lists
            </x-nav-link>
        </div>
    </header>

    <hr class="w-11/12 mt-2 mx-auto border-[#1E3A4C]">

    <div class="mt-10 text-[#1E3A4C]">
        <a href="{{ route('additems', $list) }}" class="w-full"><div class="w-11/12 lg:w-2/12 mx-auto">
            <div class="flex justify-center items-center bg-white rounded-[12px] overflow-hidden h-24 lg:h-32 border shadow-lg">
                <p class="text-grey-darker text-lg font-bold">+ add items</p>
            </div>
        </div></a>
        @foreach ($articles as $article)
            <div class="w-11/12 max-w-sm mx-auto rounded-[12px] overflow-hidden mt-5 border shadow-lg">
                <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../img/{{ $article->image }}')">
                    <button class="px-3 py-1 rounded-full bg-red-500 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        <p class="text-2xl text-white">x</p>
                    </button>
                </div>
                <div class="px-5 py-3">
                    <h3 class="text-gray-700 uppercase">{{ $article->title }}</h3>
                    <span class="text-gray-500 mt-2">€{{ $article->price }}</span>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>

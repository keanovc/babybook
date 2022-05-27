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
            <h1 class="text-[#1E3A4C] font-bold text-2xl uppercase">Reserved</h1>
            <x-nav-link :href="route('items', $list)" :active="request()->routeIs('items')">
                Items
            </x-nav-link>
        </div>
    </header>

    <hr class="w-11/12 mt-2 mx-auto border-[#1E3A4C]">

    <div class="mt-10 text-[#1E3A4C]">
        @if (count($articles) > 0)
            @foreach ($articles as $article)
                <div class="w-11/12 max-w-sm mx-auto rounded-[12px] overflow-hidden mt-5 border shadow-lg">
                    <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../img/{{ $article->image }}')"></div>
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{ $article->title }}</h3>
                        <span class="text-gray-500 mt-2">€{{ $article->price }}</span>
                        <p class="text-gray-500 mt-2">Person: {{ $order->name }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-500">No items yet</p>
        @endif
    </div>
</x-app-layout>

<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg rounded-t-2xl">
            <div class="flex">
                <div class="flex-1 group">
                    <a href="{{ route('dashboard') }}" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                list_alt
                            </span>
                            <span class="block text-xs pb-2">Lists</span>
                            <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                        </span>
                    </a>
                </div>
                <div class="flex-1 group">
                    <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-indigo-500 group-hover:text-indigo-500">
                        <span class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                article
                            </span>
                            <span class="block text-xs pb-2">Articles</span>
                            <span class="block w-5 mx-auto h-1 bg-indigo-500 group-hover:bg-indigo-500 rounded-full"></span>
                        </span>
                    </a>
                </div>
                <div class="flex-1 group">
                    <a href="{{ route('orders', $list) }}" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                redeem
                            </span>
                            <span class="block text-xs pb-2">Orders</span>
                            <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                        </span>
                    </a>
                </div>
                <div class="flex-1 group">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button onclick="event.preventDefault(); this.closest('form').submit();" type="button" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                            <span class="block px-1 pt-1 pb-1">
                                <span class="material-symbols-outlined">
                                    logout
                                </span>
                                <span class="block text-xs pb-2">Logout</span>
                                <span class="block w-5 mx-auto h-1 group-hover:bg-indigo-500 rounded-full"></span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="pt-10 text-[#1E3A4C]">
        <a href="{{ route('additems', $list) }}" class="w-full"><div class="w-10/12 max-w-sm lg:w-2/12 mx-auto">
            <div class="flex justify-center items-center bg-white rounded-[12px] overflow-hidden h-24 lg:h-32 border shadow-lg">
                <p class="text-grey-darker text-lg font-bold">+ add items</p>
            </div>
        </div></a>
        @foreach ($reservedArticles as $reservedArticle)
            <div class="w-10/12 max-w-sm mx-auto rounded-[12px] overflow-hidden mt-5 border shadow-lg">
                <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../img/{{ $reservedArticle->image }}')">
                    <div class="flex items-center justify-center h-full w-full bg-gray-900 opacity-75">
                        <p class="text-white text-center text-2xl font-bold">reserved</p>
                    </div>
                </div>
                <div class="px-5 py-3">
                    <h3 class="text-gray-700 uppercase">{{ $reservedArticle->title }}</h3>
                    <span class="text-gray-500 mt-2">€{{ $reservedArticle->price }}</span>
                </div>
            </div>
        @endforeach
        @foreach ($articles as $article)
            <div class="w-10/12 max-w-sm mx-auto rounded-[12px] overflow-hidden mt-5 border shadow-lg">
                <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('../../img/{{ $article->image }}')">
                    <form action="{{ route('items.delete', $list) }}" method="DELETE">

                        <button type="submit" class="flex px-2 py-2 rounded-full bg-red-500 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <span class="material-symbols-outlined">
                                close
                            </span>
                        </button>
                    </form>
                </div>
                <div class="px-5 py-3">
                    <h3 class="text-gray-700 uppercase">{{ $article->title }}</h3>
                    <span class="text-gray-500 mt-2">€{{ $article->price }}</span>
                </div>
            </div>
        @endforeach
    </div>
</x-guest-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 max-w-3xl mx-auto bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Articles ({{ count($articles) }})</h5>
                    <div class="w-10/12 flex justify-end items-center">
                        <div class="w-4/12 ml-6">
                            <form action="{{ route('adminDashboard') }}" method="GET">
                                <select onchange="this.form.submit()" required name="shop" id="shop" class="form-select appearance-none
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
                                    <option value="">{{ $currentShop }}</option>
                                    <hr>
                                    @foreach ($shops as $key => $shop)
                                        <option value="{{ $key }}">{{ $shop }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
               </div>
               <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($articles as $article)
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-20 h-20 rounded-full object-cover" src="img/{{ $article->image }}" alt="{{ $article->title }}">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-500 truncate dark:text-gray-500">
                                            {{ $article->category_title }}
                                        </p>
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            <a href="{{ $article->url }}" target="_blank">{{ $article->title }}</a>
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $article->price }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>

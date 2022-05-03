<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scraper') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <form action="{{ route('scraper.categories') }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap m-5">
                          <div class="w-full px-3">
                            <label class="block uppercase text-white tracking-wide text-xs mb-2" for="grid-password">
                                {{ __('Webshop') }}
                            </label>
                            <select required name="shop" id="shop" class="form-select appearance-none
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
                                @foreach ($shops as $key => $shop)
                                    <option value="{{ $key }}">{{ $shop }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="flex flex-wrap m-5">
                            <div class="w-full px-3">
                              <label class="block uppercase text-white tracking-wide text-xs mb-2">
                                    {{ __('Collection url') }}
                              </label>
                              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="url" name="url" type="url" placeholder="e.g. http://bol.com/speelgoed" required>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button class="bg-blue-500 text-white font-bold py-2 px-4 mt-4 rounded" type="submit">
                                {{ __('Scrape categories') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-16 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Categories') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Scrape</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($flamingoCategories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <div class="text-sm leading-5 font-medium text-gray-200">
                                            {{ $category->title }}
                                        </div>
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap text-right">
                                        <div class="text-sm leading-5 font-medium text-gray-200">
                                            <form action="{{ route('scraper.articles') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="url" value="{{ $category->url }}">
                                                <input type="hidden" name="shop" value="flamingo">
                                                <button class="bg-blue-500 text-white font-bold py-2 px-4 mt-4 rounded" type="submit">
                                                    {{ __('Scrape all articles') }}
                                                </button>
                                            </form>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

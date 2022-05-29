<x-guest-layout>
    <x-slot name="header">
        <h1 class="text-[#1E3A4C] font-bold text-2xl uppercase">ADD LIST</h1>
        <div class="flex items-center justify-around">
            <a href="{{ route('dashboard') }}" class="text-white bg-gray-700 hover:bg-gray-900 focus:ring-gray-300 font-medium rounded-md text-sm ml-2 px-2 pt-1">
                <span class="material-symbols-outlined">
                    close
                </span>
            </a>
        </div>
    </x-slot>

    <hr class="w-11/12 mt-2 mx-auto border-[#1E3A4C]">

    <div class="w-10/12 mx-auto mt-10 text-[#1E3A4C]">
        <form  action="{{ route('addlist.store') }}" method="POST">
            @csrf

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="name">
                        Name
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="name" type="text" name="name" required>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="name">
                        Gender
                    </label>
                    <select class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="gender" name="gender" required>
                        <option value="boy">Boy</option>
                        <option value="girl">Girl</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="description" type="text" name="description" required></textarea>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="invite">
                        Invitation Code
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="invite" type="text" name="invite" required>
                </div>
            </div>

            <div class="flex justify-center">
                <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-5 rounded focus:outline-none focus:shadow-outline" type="submit">
                    {{ __('Create List') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>

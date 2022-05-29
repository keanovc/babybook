<x-guest-layout>
    <x-slot name="header">
        <div class="px-7 bg-white shadow-lg">
            <div class="flex">
                <div class="flex-1 group">
                    <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-indigo-500 group-hover:text-indigo-500">
                        <span class="block px-1 pt-1 pb-1">
                            <span class="material-symbols-outlined">
                                list_alt
                            </span>
                            <span class="block text-xs pb-2">Lists</span>
                            <span class="block w-5 mx-auto h-1 bg-indigo-500 group-hover:bg-indigo-500 rounded-full"></span>
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
        <div class="w-10/12 max-w-sm mx-auto">
            <a href="{{ route('addlist') }}" class="flex justify-center items-center bg-white rounded-lg overflow-hidden h-24 lg:h-32 border shadow-md">
                <p class="text-grey-darker text-lg font-bold">+ add birth list</p>
            </a>
        </div>
    </div>

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
            <div class="z-10 absolute top-24 left-1/2 transform -translate-x-1/2 text-[#1E3A4C] w-10/12">
                <div class="shadow-lg bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full" role="alert">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @elseif (session('success'))
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

    <div class="container mx-auto flex flex-wrap">
        @foreach ($lists as $list)
            <div class="mt-5 py-5 bg-white font-semibold text-center rounded-lg border shadow-lg w-10/12 mx-auto sm:w-1/2 md:w-1/3 xl:w-1/3">
                <img class="mb-3 w-32 h-32 rounded-full shadow-lg mx-auto" src="https://t3.ftcdn.net/jpg/01/28/56/34/360_F_128563455_bGrVZnfDCL0PxH1sU33NpOhGcCc1M7qo.jpg" alt="baby">
                <h1 class="text-xl text-gray-700"> {{ $list->name }} </h1>
                <h3 class="text-sm text-gray-400 "> {{ $list->description }} </h3>
                <p class="text-sm text-gray-400 mt-4"> Invite: {{ $list->invitation_code }} </p>
                <div class="py-5 flex justify-center items-center">
                    <a href="{{ route('items', $list) }}" class="bg-indigo-600 px-4 py-2 mx-2 rounded-3xl text-gray-100 font-semibold uppercase tracking-wide flex items-center justify-center">
                        <span class="material-symbols-outlined">
                            visibility
                        </span>
                    </a>
                    <a href="{{ route('dashboard.copy') }}" class="bg-indigo-900 px-4 py-2 mx-2 rounded-3xl text-gray-100 font-semibold uppercase tracking-wide flex items-center justify-center">
                        <span class="material-symbols-outlined">
                            file_download
                        </span>
                    </a>
                    <form action="{{ route('dashboard.delete', $list) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="bg-red-600 px-4 py-2 mx-2 rounded-3xl text-gray-100 font-semibold uppercase tracking-wide flex items-center justify-center">
                            <span class="material-symbols-outlined">
                                delete
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-guest-layout>

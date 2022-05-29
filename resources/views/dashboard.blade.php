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
        <a href="{{ route('addlist') }}"><div class="w-10/12 max-w-sm mx-auto">
            <div class="flex justify-center items-center bg-white rounded-lg overflow-hidden h-24 lg:h-32 border shadow-md">
                <p class="text-grey-darker text-lg font-bold">+ add birth list</p>
            </div>
        </div></a>
    </div>

    @foreach ($lists as $list)
        <div class="mt-5 py-5 bg-white font-semibold text-center rounded-lg max-w-sm border shadow-lg w-10/12 lg:w-2/12 mx-auto">
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
                <a href="{{ route('items', $list) }}" class="bg-red-600 px-4 py-2 mx-2 rounded-3xl text-gray-100 font-semibold uppercase tracking-wide flex items-center justify-center">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                </a>
            </div>
        </div>
    @endforeach
</x-guest-layout>

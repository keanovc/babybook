<x-app-layout>
    <svg class="lg:hidden" width="390" height="74" viewBox="0 0 390 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M179.5 46C132.364 36.2406 -8.50609 29.3876 -55 23.5L-28.5047 -25H458.932C462.264 12.0698 376.496 70.4066 344.5 72.5C304.505 75.1167 293 69.5 179.5 46Z" fill="#9EC4C5"/>
        <path d="M219.429 -15.1767C98.7047 -7.31814 3.5079 25.5488 -29 41L1.79696 -25H203.004C258.78 -25 340.153 -23.0353 219.429 -15.1767Z" fill="#F3C2C2"/>
    </svg>

    <header class="pt-6">
        <div class="flex justify-between items-center w-10/12 m-auto">
            <h1 class="text-[#1E3A4C] font-bold text-2xl uppercase">Lists</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button onclick="event.preventDefault();
                this.closest('form').submit();" class="h-6 text-[#1E3A4C]"> {{ __('LOGOUT') }} </button>
            </form>
        </div>
    </header>

    <hr class="w-11/12 mt-2 mx-auto border-[#1E3A4C]">

    <div class="mt-10 text-[#1E3A4C]">
        <a href="/addlist"><div class="w-11/12 lg:w-2/12 mx-auto transition duration-300 hover:scale-105">
            <div class="flex justify-center items-center bg-white rounded-[12px] overflow-hidden h-24 lg:h-32 border shadow-md">
                <p class="text-grey-darker text-lg font-bold">+ add birth list</p>
            </div>
        </div></a>
    </div>

    @foreach ($lists as $list)
        <div class="mt-5 text-[#1E3A4C]">
            <form method="GET" action="{{ route('items', $list->id) }}">
                @csrf

                <button type="submit" class="w-full"><div class="w-11/12 lg:w-2/12 mx-auto transition duration-300 hover:scale-105">
                    <div class="flex items-center justify-between bg-white rounded-[12px] overflow-hidden h-24 lg:h-32 border shadow-md">
                        <div class="flex">
                            <div class="w-2/12 mx-5">
                                <img class="rounded-full" src="https://t3.ftcdn.net/jpg/01/28/56/34/360_F_128563455_bGrVZnfDCL0PxH1sU33NpOhGcCc1M7qo.jpg" alt="baby">
                            </div>
                            <div class="text-left">
                                <p class="text-grey-darker text-lg font-bold uppercase">{{ $list->name }}</p>
                                <p class="text-grey-darker text-lg">{{ $list->description }}</p>
                            </div>
                        </div>
                        <div class="mx-5">
                            <p class="text-red-500">X</p>
                        </div>
                    </div>
                </div></button>
            </form>
        </div>
    @endforeach
</x-app-layout>

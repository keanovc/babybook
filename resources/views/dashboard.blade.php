<x-app-layout>
    <svg width="390" height="74" viewBox="0 0 390 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M179.5 46C132.364 36.2406 -8.50609 29.3876 -55 23.5L-28.5047 -25H458.932C462.264 12.0698 376.496 70.4066 344.5 72.5C304.505 75.1167 293 69.5 179.5 46Z" fill="#9EC4C5"/>
        <path d="M219.429 -15.1767C98.7047 -7.31814 3.5079 25.5488 -29 41L1.79696 -25H203.004C258.78 -25 340.153 -23.0353 219.429 -15.1767Z" fill="#F3C2C2"/>
    </svg>

    <header class="mt-6">
        <div class="flex justify-between items-center w-10/12 m-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-simpleline-logout onclick="event.preventDefault();
                this.closest('form').submit();" class="h-6 text-[#1E3A4C]"/>
            </form>
            <h1 class="text-[#1E3A4C] font-bold text-2xl uppercase">Items</h1>
            <x-nav-link :href="route('reserved')" :active="request()->routeIs('reserved')">
                <x-akar-check-box-fill class="h-6 text-[#1E3A4C]"/>
            </x-nav-link>
        </div>
    </header>

    <hr class="w-11/12 mt-2 mx-auto border-[#1E3A4C]">

    <div class="mt-5 text-[#1E3A4C]">
        <div class="w-11/12 mt-10 mx-auto">
            <div class="flex justify-between bg-white rounded-[12px] overflow-hidden h-auto lg:h-32 border shadow shadow-xl">
              <div class="flex">
                <img class="block object-cover h-24 w-6/12 flex-none bg-cover" src="https://www.petiteamelie.be/media/catalog/product/cache/10/thumbnail/1024x/85e4522595efc69f496374d01ef2bf13/d/o/doorgroei-babybed-cerise-wit-hout-petite-amelie.jpg">
                <div class="bg-white ml-2 rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                  <div class="font-bold text-xl mb-2 leading-tight">Babybed</div>
                  <p class="text-base">€125.99</p>
                </div>
              </div>
              <div class="flex items-center mr-5">
                <x-icomoon-bin class="h-6 text-[#DC143C]" />
              </div>
            </div>
        </div>
        <div class="w-11/12 mt-5 mx-auto">
            <div class="flex justify-between bg-white rounded-[12px] overflow-hidden h-auto lg:h-32 border shadow shadow-xl">
              <div class="flex">
                <img class="block object-cover h-24 w-6/12 flex-none bg-cover" src="https://previews.123rf.com/images/bowie15/bowie151204/bowie15120400022/13114266-isolated-young-businessman-driving-a-toy-car.jpg">
                <div class="bg-white ml-2 rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                  <div class="font-bold text-xl mb-2 leading-tight">Autotje</div>
                  <p class="text-base">€18.99</p>
                </div>
              </div>
              <div class="flex items-center mr-5">
                <x-icomoon-bin class="h-6 text-[#DC143C]" />
              </div>
            </div>
        </div>
        <a href="/additems"><div class="w-11/12 mt-5 mx-auto">
            <div class="flex justify-center items-center bg-white rounded-[12px] overflow-hidden h-24 lg:h-32 border shadow shadow-xl">
                <p class="text-grey-darker text-lg font-bold">+ add items</p>
            </div>
        </div></a>
    </div>
</x-app-layout>

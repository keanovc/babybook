@if (Route::has('login'))
    <div class="flex items-center justify-left mb-10">
        @auth
            {{-- <a href="{{ url('/admin-dashboard') }}" class="text-xl text-white">Dashboard</a> --}}
            @if (Auth::user()->is_admin == 1)
                <a href="{{ url('/adminDashboard') }}" class="text-xl text-white">Dashboard</a>
            @else
                <a href="{{ url('/dashboard') }}" class="text-xl text-white">Dashboard</a>
            @endif
        @else
            <div class="flex flex-col">
                <a href="{{ route('login') }}" class="text-4xl xl:text-xl ml-1 mb-1 text-gray-500 {{ (request()->is('/')) ? 'text-white' : '' }}">Log in</a>
                <hr class="w-48 xl:w-28 border-gray-500 {{ (request()->is('/')) ? 'border-[#F3C2C2]' : '' }}">
            </div>


            @if (Route::has('register'))
                <div class="flex flex-col">
                    <a href="{{ route('register') }}" class="text-4xl xl:text-xl ml-1 mb-1 text-gray-500 {{ (request()->is('register')) ? 'text-white' : '' }}">Register</a>
                    <hr class="w-48 xl:w-28 border-gray-500 {{ (request()->is('register')) ? 'border-[#F3C2C2]' : '' }}">
                </div>
            @endif
        @endauth
    </div>
@endif

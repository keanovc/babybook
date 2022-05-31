<x-cart-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="p-6  md:mx-auto">
            <svg viewBox="0 0 24 24" class="text-green-400 w-16 h-16 mx-auto my-6">
                <path fill="currentColor"
                    d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                </path>
            </svg>
            <div class="text-center">
                <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">{{ __('Payment Done!') }}</h3>
                <p class="text-gray-600 my-2">{{ __('Thank you for completing your secure online payment, we send you a mail wit all the details of your order') }}.</p>
                <p>{{ __('Have a great day!') }}</p>
                <div class="py-10 text-center">
                    <a href="{{ route('invitation') }}" class="px-12 bg-indigo-500 rounded-md hover:bg-indigo-500 text-white font-semibold py-3 transition duration-500 hover:scale-105">
                        {{ __('GO BACK') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-cart-layout>

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full h-12 px-6 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800']) }}>
    {{ $slot }}
</button>

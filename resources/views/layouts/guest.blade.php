<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/clipboard.min.js') }}"></script>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-indigo-100 pt-16 pb-5">
            <header class="block fixed inset-x-0 top-0 z-10">
                {{ $header }}
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    <script>
        var clipboard = new ClipboardJS('.btn');

        clipboard.on('success', function(e) {
            scrollTo(0, 0);
            document.querySelector('.copied').classList.remove('hidden');
            document.querySelector('.copied').classList.add('block');
            setTimeout(function() {
                document.querySelector('.copied').classList.remove('block');
                document.querySelector('.copied').classList.add('hidden');
            }, 2000);
        });
    </script>
</html>

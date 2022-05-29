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

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        <style>
            .background {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' width='390' height='844' preserveAspectRatio='none' viewBox='0 0 390 844'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1221%26quot%3b)' fill='none'%3e%3crect width='390' height='844' x='0' y='0' fill='rgba(245%2c 228%2c 220%2c 1)'%3e%3c/rect%3e%3cpath d='M 0%2c367 C 39%2c324.4 117%2c180.4 195%2c154 C 273%2c127.6 351%2c218.8 390%2c235L390 844L0 844z' fill='rgba(158%2c 196%2c 197%2c 1)'%3e%3c/path%3e%3cpath d='M 0%2c762 C 39%2c715.6 117%2c537.8 195%2c530 C 273%2c522.2 351%2c684.4 390%2c723L390 844L0 844z' fill='rgba(243%2c 194%2c 194%2c 1)'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1221'%3e%3crect width='390' height='844' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
            }

            @media (min-width: 600px) {
                .background {
                    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' width='1920' height='1080' preserveAspectRatio='none' viewBox='0 0 1920 1080'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1041%26quot%3b)' fill='none'%3e%3crect width='1920' height='1080' x='0' y='0' fill='rgba(245%2c 228%2c 220%2c 1)'%3e%3c/rect%3e%3cpath d='M 0%2c277 C 128%2c241.4 384%2c98 640%2c99 C 896%2c100 1024%2c290 1280%2c282 C 1536%2c274 1792%2c103.6 1920%2c59L1920 1080L0 1080z' fill='rgba(158%2c 196%2c 197%2c 1)'%3e%3c/path%3e%3cpath d='M 0%2c986 C 128%2c945 384%2c764.8 640%2c781 C 896%2c797.2 1024%2c1078.2 1280%2c1067 C 1536%2c1055.8 1792%2c793.4 1920%2c725L1920 1080L0 1080z' fill='rgba(243%2c 194%2c 194%2c 1)'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1041'%3e%3crect width='1920' height='1080' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="background bg-cover bg-no-repeat bg-center bg-fixed">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ $lang }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lang === 'en' ? 'Statistics Login' : 'Statisztika Belepes' }}</title>
    <link rel="stylesheet" href="{{ asset('Style.css') }}">
</head>

<body>
    <canvas id="matrix"></canvas>

    <div class="statistics-shell">
        @yield('content')
    </div>

    <script>
        const typewriterLines = [];
        const preloaderLines = [];
    </script>
    <script src="{{ asset('script.js') }}"></script>
</body>

</html>

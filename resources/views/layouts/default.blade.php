<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title') | Good System Community
    </title>

    <link rel="stylesheet" href="/css/tailwind-ui.min.css">
</head>
<body>
<div>
    <nav></nav>
    <main>
        <div>
            @yield('content')
        </div>
    </main>
    <footer class="text-center">

    </footer>
</div>
</body>
</html>

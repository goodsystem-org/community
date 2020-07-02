<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta property="og:url" content="https://kidsconnect.live/">
    <meta property="og:title" content="Kids Connect program">
    <meta property="og:description" content="Community program to help stay-at-home kids connect, social, and learn.">

    <title>
        @section('title')
        HOME
        @show
        | Kids Connect
    </title>

    <link rel="stylesheet" href="/css/tailwind-ui.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>

    @yield('top-styles-scripts')

</head>
<body>
<div class="relative bg-white overflow-hidden">
    <div class="max-w-screen-xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:w-full lg:pb-28 xl:pb-32">
            <div>
                @include('navigation')
            </div>

            <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 mt-4 sm:mt-8">
                @yield('content')
                @yield('vue-app')
            </div>
        </div>
    </div>
    @include('footer')
</div>

@yield('bottom-scripts')

</body>
</html>

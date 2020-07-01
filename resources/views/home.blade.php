<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        HOME | Good System Community
    </title>

    <link rel="stylesheet" href="/css/tailwind-ui.min.css">
</head>
<body>
<div class="relative bg-white overflow-hidden">
    <div class="hidden lg:block lg:absolute lg:inset-0">
        <svg class="absolute top-0 left-1/2 transform translate-x-64 -translate-y-8" width="640" height="784" fill="none" viewBox="0 0 640 784">
            <defs>
                <pattern id="9ebea6f4-a1f5-4d96-8c4e-4c2abf658047" x="118" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                </pattern>
            </defs>
            <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor" />
            <rect x="118" width="404" height="784" fill="url(#9ebea6f4-a1f5-4d96-8c4e-4c2abf658047)" />
        </svg>
    </div>
    <div class="relative pt-6 pb-16 md:pb-20 lg:pb-24 xl:pb-32">
        <nav class="relative max-w-screen-xl mx-auto flex items-center justify-between px-4 sm:px-6">
            <div class="flex items-center flex-1">
                <div class="flex items-center justify-between w-full md:w-auto">
                    <a href="/" aria-label="Home" class="border-2 border-blue-800 rounded px-2 py-1 text-blue-800 font-bold text-center">
                        GOOD SYSTEM<br>
                        <span class="text-lg">Community</span>
                    </a>
                    <span class="inline-flex ml-16 text-2xl mr-1">
                        <a href="{{ request()->query('language') === 'cn' ? '/' : '/?language=cn' }}" class="underline">
                        {{ request()->query('language') === 'cn' ? 'English' : '中文' }}
                        </a>
                    </span>

                    {{--<div class="-mr-2 flex items-center md:hidden">
                        <button id="open-menu" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" id="main-menu" aria-label="Main menu" aria-haspopup="true">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>--}}
                </div>{{--
                <div class="hidden md:block md:ml-10">
                    <a href="" class="opacity-50 cursor-not-allowed font-medium text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out">
                        {{ __('coming-soon.menu.business_directory') }}
                    </a>
                </div>--}}
            </div>
            <div class="hidden md:block text-right">

                {{--<span class="inline-flex rounded-md shadow-md">
                    <span class="inline-flex rounded-md shadow-xs">
                        <button disabled class="cursor-not-allowed opacity-50 inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo transition duration-150 ease-in-out">
                        {{ __('coming-soon.login') }}
                        </button>
                    </span>
                </span>--}}
            </div>
        </nav>

        <!--
          Mobile menu, show/hide based on menu open state.

          Entering: "duration-150 ease-out"
            From: "opacity-0 scale-95"
            To: "opacity-100 scale-100"
          Leaving: "duration-100 ease-in"
            From: "opacity-100 scale-100"
            To: "opacity-0 scale-95"
        -->
        <div id="menu" class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right hidden md:hidden">
            <div class="rounded-lg shadow-md">
                <div class="rounded-lg bg-white shadow-xs overflow-hidden" role="menu" aria-orientation="vertical" aria-labelledby="main-menu">
                    <div class="px-5 pt-4 flex items-center justify-between">
                        <a href="/" aria-label="Home" class="border-2 border-blue-800 rounded px-2 py-1 text-blue-800 text-center font-bold">
                            GOOD SYSTEM<br>
                            <span class="text-lg">Community</span>
                        </a>
                        <div class="-mr-2">
                            <button id="close-menu" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" aria-label="Close menu">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="px-2 pt-2 pb-3">
                        <a href="" class="opacity-25 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out" role="menuitem">{{ __('coming-soon.menu.business_directory') }}
                        </a>{{--
                        <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out" role="menuitem">Features
                        </a>
                        <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out" role="menuitem">Marketplace
                        </a>
                        <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out" role="menuitem">Company
                        </a>--}}
                    </div>
                    <div>
                        <a href="{{ request()->query('language') === 'cn' ? '/' : '/?language=cn' }}" class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100 hover:text-indigo-700 focus:outline-none focus:bg-gray-100 focus:text-indigo-700 transition duration-150 ease-in-out" role="menuitem">
                            {{ request()->query('language') === 'cn' ? 'English' : '中文' }}
                        </a>
{{--
                        <a href="#" class="opacity-25 block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100 hover:text-indigo-700 focus:outline-none focus:bg-gray-100 focus:text-indigo-700 transition duration-150 ease-in-out" role="menuitem">
                            {{ __('coming-soon.login') }}
                        </a>--}}
                    </div>
                </div>
            </div>
        </div>

        <main class="mt-8 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-20 xl:mt-24">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <div class="text-sm mb-4 font-semibold uppercase tracking-wide text-gray-500 sm:text-base lg:text-sm xl:text-base">
                        {{ __('coming-soon.home.coming_soon') }}
                    </div>
                    <h2 class="mt-1 text-xl tracking-tight leading-10 font-extrabold text-gray-900 sm:leading-none sm:text-3xl lg:text-4xl xl:text-5xl">
                        {{ __('coming-soon.home.head_line_1') }}
                        <br class="hidden md:inline" />
                        {{ __('coming-soon.home.head_line_2') }}
                        <br class="hidden md:inline" />
                        <span class="block sm:inline-block text-indigo-600">{{ __('coming-soon.home.tag_line_1') }}
                            <br class="hidden md:inline" />
                            {{ __('coming-soon.home.tag_line_2') }}
                        </span>
                    </h2>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                        {{ __('coming-soon.summary.line_1') }}
                        <br>{{ __('coming-soon.summary.line_2') }}
                    </p>
                    <div class="mt-5 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                        @if(!isset($signupDone))
                            <p class="text-base font-medium text-gray-900">
                                {{ __('coming-soon.signup') }}
                            </p>
                            <form action="" method="POST" class="mt-3 sm:flex">
                                @csrf
                                <input aria-label="Email" name="email" value="{{ old('email') }}" class="appearance-none block w-full px-3 py-3 border border-gray-300 text-base leading-6 rounded-md placeholder-gray-500 shadow-sm focus:outline-none focus:placeholder-gray-400 focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:flex-1" placeholder="{{ __('coming-soon.enter_your_email') }}" />
                                <button type="submit" class="mt-3 w-full px-6 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-800 shadow-sm hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray active:bg-gray-900 transition duration-150 ease-in-out sm:mt-0 sm:ml-3 sm:flex-shrink-0 sm:inline-flex sm:items-center sm:w-auto">
                                    {{ __('coming-soon.notify_me') }}
                                </button>
                            </form>
                            @error('email')
                            <div class="text-sm text-red-400 m-4 italic">{{ $errors->first('email') }}</div>
                            @enderror
                        @else
                            <div class="text-green-400">
                            {{ __('coming-soon.gotten_your_email') }}
                            </div>
                        @endif

                        <div class="mt-3 sm:flex">
                            {{ __('coming-soon.connect_by_wechat') }}
                        </div>

                        <p class="mt-3 text-sm leading-5 text-gray-500">
                            We care about the protection of your data. Read our
                            <a href="https://goodsystem.org/privacy" class="font-medium text-gray-900 underline" target="_blank">Privacy Policy</a>.
                        </p>
                    </div>
                </div>
                <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                    <svg class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-8 scale-75 origin-top hidden" width="640" height="784" fill="none" viewBox="0 0 640 784">
                        <defs>
                            <pattern id="4f4f415c-a0e9-44c2-9601-6ded5a34a13e" x="118" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                            </pattern>
                        </defs>
                        <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor" />
                        <rect x="118" width="404" height="784" fill="url(#4f4f415c-a0e9-44c2-9601-6ded5a34a13e)" />
                    </svg>
                    <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                        <button type="button" class="relative block w-full rounded-lg overflow-hidden focus:outline-none focus:shadow-outline">
                            <img class="w-full" src="/images/collage.jpeg" "alt="businesses" />
                            {{--<div class="absolute inset-0 w-full h-full flex items-center justify-center">
                                <svg class="h-20 w-20 text-indigo-500" fill="currentColor" viewBox="0 0 84 84">
                                    <circle opacity="0.9" cx="42" cy="42" r="42" fill="white" />
                                    <path d="M55.5039 40.3359L37.1094 28.0729C35.7803 27.1869 34 28.1396 34 29.737V54.263C34 55.8604 35.7803 56.8131 37.1094 55.9271L55.5038 43.6641C56.6913 42.8725 56.6913 41.1275 55.5039 40.3359Z" />
                                </svg>
                            </div>--}}
                        </button>
                    </div>
                </div>
            </div>
        </main>
        <div class="mt-24 lg:mt-0">
        @include('layouts.footer')
        </div>
    </div>
</div>
<script>
    document.getElementById('close-menu').addEventListener('click', () => {
        document.getElementById('menu').classList.add('hidden')
    })
    document.getElementById('open-menu').addEventListener('click', () => {
        document.getElementById('menu').classList.remove('hidden')
    })
</script>
</body>
</html>

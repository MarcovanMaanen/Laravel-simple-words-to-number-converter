<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ __('message.laravel_title') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>
<body class="bg-gray-100">
<nav class="flex flex-col sm:flex-row flex-wrap md:items-center px-4 md:px-5 lg:px-16 py-2 justify-between border-b border-gray-600 fixed top-0 z-20 w-full bg-slate-900">
    <ul class="hidden sm:flex text-gray-400 justify-end items-center gap-x-7 gap-y-5 tracking-wide mt-5 sm:mt-0"
        id="links">
        <li class="table-caption mb-5 sm:mb-0">
            <a href="{{ url('/') }}">{{ __('message.home_text') }}</a>
        </li>
    </ul>
    @include('partials/language_switcher')

</nav>

<x-flag-country-us />
<main>
    <section class="text-center py-32">
        <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl pb-7">{{ __('message.converter_title') }}</h1>
        <div class="md:container md:mx-auto">
            <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                <p class="font-bold">{{ __('message.information_header') }}</p>
                <p class="text-sm">{{ __('message.information_text') }}</p>
            </div>
            <br><br>
            @if (Route::has('convert'))
                <form method="POST" action="{{ route('convert') }}">
                    @csrf
                    <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                           placeholder="{{ __('message.input_placeholder') }}"
                           type="text"
                           name="input"/>
                    <br>
                    <button
                            type="submit"
                            class="py-2 px-3 bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold rounded-md shadow focus:outline-none">
                        {{ __('message.button_text') }}
                    </button>
                    <br><br>
                    @if ($errors->any())
                        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Danger</span>
                            <div>
                                <span class="font-medium">{{ __('message.error_header_text') }}</span>
                                <ul class="mt-1.5 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </form>
            @endif
        </div>
    </section>



</main>
</body>

</html>

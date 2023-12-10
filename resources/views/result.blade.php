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
<main>
    <section class="text-center py-32">
        <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl pb-7">{{ __('message.result_header_text') }}</h1>
        <div class="md:container md:mx-auto">
            @if (Route::has('convert'))
                <p>{{ __('message.input_text') }}: {{ $input }}</p>
                <p>{{ __('message.result_text') }}: {{ $result }}</p>
                @if (Route::has('index'))
                    <a href="{{ route('index') }}"
                       class="inline-block px-6 py-3 text-blue-100 no-underline bg-blue-500 rounded hover:bg-blue-600 hover:underline hover:text-blue-200">
                        {{ __('message.result_back_to_home') }}
                    </a>
                @endif
            @endif
        </div>
    </section>



</main>
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Feature Flagging Demo</title>

    <!-- Fonts -->
    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="font-sans antialiased">
    <div class="flex items-center justify-center h-screen">
        <div class="p-4 space-y-2 border rounded-lg">
            <h1 class="text-2xl">@lang('welcome.heading')</h1>
            @php
                $features = [
                    'foo' => false,
                    'bar' => false,
                    'baz' => false,
                ];
            @endphp
            @foreach ($features as $feature => $state)
                <p>
                    {{ ucfirst($feature) }}
                    <span @class([
                        'align-middle inline-block rounded-full text-xs px-2 font-bold text-white',
                        'bg-green-500' => $state,
                        'bg-red-500' => !$state,
                    ])>
                        @if ($state)
                            @lang('welcome.feature.enabled')
                        @else
                            @lang('welcome.feature.disabled')
                        @endif
                    </span>
                    @dump($state)
                </p>
            @endforeach
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Приемная комиссия')</title>
    <link rel="shortcut icon" href="{{asset('media/images/logo/1.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
    <script src="{{ asset('js/main.js') }}?v={{ filemtime(public_path('js/main.js')) }}" defer></script>
</head>
<body>
<div class="page">
    @include('partials.announcement-bar')
    @unless(request()->routeIs('view.main'))
        @include('includes.header')
    @endunless
    @yield('content')

    @include('includes.footer')
</div>
@include('partials.site-modals')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description', 'hana\'s bbs'), {{ setting('seo_description') }}">
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword')), hana, bbs">
    <meta name="slug" content="@yield('slug', env('APP_URL'))">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body>
<div id="app" class="{{ route_class() }}-page">

    @include('layouts._header')

    <div class="container">

        @include('shared._messages')

        @yield('content')

    </div>

    @include('layouts._footer')
</div>

@auth
    @if(app()->isLocal())
        @include('layouts._impersonate')
    @endif
@endauth

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>

@yield('scripts')

</body>

</html>

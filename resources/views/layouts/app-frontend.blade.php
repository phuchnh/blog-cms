<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.meta')
    @include('includes.assets')
</head>

<body id="website">
@include('includes.header')

<!-- main content -->
<main id="main">
    {!! Ssr::entry('js/entry-server.js')->fallback('<div id="app"></div>')->render() !!}
    <script src="{{ asset('js/entry-client.js') }}"></script>

    @yield('content')
</main>

@include('includes.footer')
</body>

</html>

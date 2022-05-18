<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="{{ asset('themes/user/images/favicon.png') }}">

    <meta name="description" content="Jual Furniture Murah Meriah" />
    <meta name="keywords" content="furniture, RnD-furniture" />
    @stack('prepend-style')
    @include('includes.user.style')
    @stack('addon-style')
    <title>@yield('title') </title>
</head>

<body>

    @include('includes.user.navbar')

    @yield('content')

    @include('includes.user.footer')

    @stack('prepend-script')
    @include('includes.user.script')
    @stack('addon-script')

</body>

</html>

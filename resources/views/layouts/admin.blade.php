<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @stack('prepend-style')
    @include('includes.admin.style')
    @stack('addon-style')

    <link rel="shortcut icon" href="{{ asset('themes/admin/assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('themes/admin/assets/images/logo/favicon.png') }}" type="image/png">

</head>

<body>
    <div id="app">
        @include('includes.admin.sidebar')
        <div id="main" class='layout-navbar'>
            @include('includes.admin.navbar')
            <div id="main-content">
                @yield('content')
                @include('includes.admin.footer')
            </div>
        </div>
    </div>

    @stack('prepend-script')
    @include('includes.admin.script')
    @stack('addon-script')

</body>

</html>

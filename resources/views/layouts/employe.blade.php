<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@yield('title', 'Dashboard')</title>
</head>

@php
    function isActive($route) {
        return request()->routeIs($route) ? 'block p-3 bg-blue-50 text-blue-700 rounded-lg font-bold text-sm' : 'block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition';
    }
@endphp

<body class="bg-gray-100 font-sans text-gray-800">

    <div class="flex min-h-screen">
        @include("partials.employe-sidebar")

        @yield('content')
    </div>

</body>

</html>

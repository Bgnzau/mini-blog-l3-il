<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    @include('components.dashboard.topbar')

    <div style="display: flex;">
        @include('components.dashboard.sidebar')
        
        <main style="flex: 1; padding: 20px;">
            @yield('content')
        </main>
    </div>
</body>
</html>
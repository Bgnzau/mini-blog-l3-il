{{--
    EXERCICE — Question 1 : Layout racine de la partie DASHBOARD (administration)
    Les vues du dossier dashboard/ doivent UNIQUEMENT étendre ce layout (pas app.blade.php),
    afin d'éviter d'afficher par erreur la navbar publique sur l'admin.
--}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard — Le Blog')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
   
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>

    @include('components.dashboard.sidebar')

    <div class="main">
       
        @include('components.dashboard.topbar')
        <div class="content">
            @yield('content')
        </div>
    </div>

</body>

</html>

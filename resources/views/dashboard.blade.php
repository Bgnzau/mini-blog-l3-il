<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body style="margin: 0; padding: 0; background-color: #111116;">

    {{-- CE CONTENEUR FLEX FORCE L'ALIGNEMENT CÔTE À CÔTE --}}
    <div style="display: flex; min-height: 100vh; width: 100%;">
        
        {{-- 1. On inclut ta barre latérale fixe --}}
        @include('components.dashboard.sidebar')

        {{-- 2. La zone de contenu prend tout le reste de la place à droite --}}
        <div style="flex: 1; min-width: 0; box-sizing: border-box;">
            @yield('content')
        </div>

    </div>

</body>
</html>
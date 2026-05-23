<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### Question 1 — Layouts Blade
*   **Quelle est la différence entre @yield('title') et @yield('title', 'Valeur par défaut') ?**
    > @yield('title') n'affiche rien si la vue enfant ne définit pas de section 'title'. En revanche, @yield('title', 'Valeur par défaut') permet de définir une chaîne de caractères de secours qui s'affichera automatiquement si l'enfant omit de spécifier cette section.
*   **Pourquoi utilise-t-on @extends plutôt que d'inclure le header et le footer manuellement dans chaque fichier de vue ?**
    > L'utilisation d' @extends applique le principe de l'inversion de contrôle et du DRY (Don't Repeat Yourself). Au lieu que chaque vue construise sa structure en incluant des morceaux, c'est le layout général qui gère le squelette global HTML. Cela centralise la maintenance : une modification dans le layout profite instantanément à toutes les pages.
*   **Comment s'assure-t-on qu'une vue du dashboard n'étende jamais accidentellement le layout public ?**
    > On s'en assure par une convention de nommage rigoureuse et une architecture de dossiers étanche (séparation entre views/public et views/dashboard). Lors du développement, il suffit de vérifier de manière stricte que le fichier de vue d'administration commence bien par @extends('dashboard') et non @extends('app').

### Question 3 — Assets & Composants du dashboard
*   **Comment rendre la classe active d'un lien de la sidebar dynamique selon la route courante, en utilisant request()->routeIs() ou Route::currentRouteName() ?**
    > On utilise une condition ternaire directement dans l'attribut class du lien HTML : class="{{ request()->routeIs('dashboard.articles') ? 'active' : '' }}". Si le nom de la route courante concorde avec le paramètre, Laravel injecte la classe active.
*   **Pourquoi est-il préférable de placer les composants du dashboard dans un sous-dossier components/dashboard/ plutôt que directement dans components/ ?**
    > Pour des raisons de clarté, de modularité et pour éviter les conflits de noms (par exemple, avoir un sidebar.blade.php pour le public et un autre pour l'administration). Structurer en sous-dossiers facilite le travail en équipe.

### Question 4 — Création des routes
*   **Quelle est la différence entre Route::get() et Route::post() ? Dans quel cas utilise-t-on l'un plutôt que l'autre ?**
    > Route::get() est utilisé pour demander / récupérer une ressource sans modifier l'état du serveur (ex: afficher une page). Route::post() est utilisé pour envoyer des données sensibles ou complexes au serveur afin de créer ou modifier une ressource (ex: soumettre un formulaire d'inscription).
*   **Comment déclarer et nommer une route avec la méthode ->name() ? Pourquoi les noms de routes sont-ils indispensables pour utiliser route() dans les vues Blade ?**
    > On la déclare ainsi : Route::get('/url', [Controller::class, 'methode'])->name('mon.nom.de.route');. Les noms sont indispensables car ils découplent l'URL physique du code. Si l'URL change de /about à /a-propos-de-nous, aucun lien dans les vues Blade utilisant route('about') ne sera cassé.
*   **Qu'est-ce qu'un paramètre de route dynamique comme {id} ? Comment le récupérer dans le contrôleur ?**
    > C'est un segment variable dans l'URL qui permet de transmettre une information à Laravel (comme l'identifiant d'un article). On le récupère dans le contrôleur en le passant simplement comme argument de la méthode associée : public function show($id) { ... }.
*   **Que se passe-t-il si deux routes ont la même URL mais des méthodes HTTP différentes (GET et POST) ?**
    > Laravel les traite comme deux routes totalement distinctes. L'une sera appelée lors de l'accès classique à l'URL (GET) et l'autre lors de la soumission d'un formulaire vers cette même URL (POST).

### Question 5 — Groupement des routes du dashboard
*   **Quelle est la syntaxe complète pour créer un groupe de routes avec un préfixe d'URL et un préfixe de nom en même temps ?**
    > Route::prefix('dashboard')->name('dashboard.')->group(function () { // les routes ici });
*   **Quelle est la différence entre Route::prefix() et Route::middleware() dans un groupe de routes ?**
    > Route::prefix() modifie uniquement l'esthétique et la structure des URLs du groupe (aspect technique de routage), tandis que Route::middleware() applique des couches de sécurité ou de filtrage (ex: vérifier si l'utilisateur est connecté/administrateur avant de lui donner l'accès).
*   **Qu'est-ce que Route::resource() ? Pour quelles ressources (articles, catégories, utilisateurs) serait-il pertinent de l'utiliser et quelles routes génère-t-il automatiquement ?**
    > C'est une méthode macro qui génère automatiquement les 7 routes standard du CRUD (Create, Read, Update, Delete) en une seule ligne. Elle est pertinente pour toutes ces ressources (articles, categories, users). Elle génère automatiquement les routes pour index, create, store, show, edit, update, et destroy.

### Question 6 — Création des contrôleurs
*   **Quelle est la commande artisan pour générer un contrôleur ? Quelle option ajouter pour générer directement un contrôleur de ressource avec toutes les méthodes CRUD ?**
    > La commande est php artisan make:controller MonController. Pour obtenir un contrôleur de ressource, on ajoute l'option --resource (ou -r).
*   **Quelle est la convention de nommage des méthodes d'un contrôleur de ressource Laravel (index, show, create, store, edit, update, destroy) ? À quelle action correspond chacune ?**
    *   index : Liste les ressources.
    *   create : Affiche le formulaire de création.
    *   store : Enregistre la nouvelle ressource en BDD.
    *   show : Affiche une ressource spécifique.
    *   edit : Affiche le formulaire de modification.
    *   update : Traite la modification en BDD.
    *   destroy : Supprime la ressource.
*   **Quelle est la différence entre ces trois façons de passer des données à une vue depuis un contrôleur ?**
    > Elles produisent exactement le même résultat final. ['posts' => $posts] est la syntaxe de tableau associatif classique. compact('posts') est un raccourci PHP ultra propre qui crée le tableau associatif à partir du nom de la variable. ->with('posts', $posts) est une méthode fluide chaînée à l'objet vue de Laravel.
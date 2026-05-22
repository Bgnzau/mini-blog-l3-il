# Évaluation — Mini Blog Laravel / Blade

**Module :** Développement Web avec Laravel
**Niveau :** L3 — Informatique et Logiciels
**Dépôt GitHub :** [Dr-Lab1/mini-blog-l3-il](https://github.com/Dr-Lab1/mini-blog-l3-il)

---

## Mise en place du projet

Avant de commencer l'évaluation, effectuez les étapes suivantes dans l'ordre :

```bash
# 1. Cloner le dépôt GitHub
git clone https://github.com/Dr-Lab1/mini-blog-l3-il.git

# 2. Se déplacer dans le répertoire du projet
cd mini-blog-l3-il

# 3. Installer les dépendances PHP
composer install

# 4. Copier le fichier d'environnement
cp .env.example .env

# 5. Générer la clé de l'application
php artisan key:generate
```

> Assurez-vous d'avoir **PHP 8.1+**, **Composer** et **Laravel 10+** installés sur votre machine avant de commencer.

---

## Travail à réaliser

### Question 1 — Layouts Blade (racines des deux parties)

Créez deux fichiers root Blade distincts :

- `resources/views/App.blade.php` → pour la **partie publique** du blog
- `resources/views/Dashboard.blade.php` → pour la **partie dashboard** (administration)

Chaque root doit utiliser les directives `@yield` pour définir les zones dynamiques (au minimum : `title`, `content`). Chaque vue enfant devra utiliser `@extends` pour hériter du bon layout et `@section` / `@endsection` pour injecter son contenu dans les zones correspondantes.

**Questions :**

1. Quelle est la différence entre `@yield('title')` et `@yield('title', 'Valeur par défaut')` ?

**Réponse :** Les deux affichent le contenu d'une section définie par une vue enfant avec `@section('title')`. Avec `@yield('title')` seul, si la vue enfant ne définit pas cette section, rien n'est affiché (zone vide). Avec `@yield('title', 'Valeur par défaut')`, Laravel affiche la section si elle existe, sinon la valeur par défaut fournie (ici « Valeur par défaut »). C'est utile pour éviter un `<title>` vide ou un contenu manquant.

2. Pourquoi utilise-t-on `@extends` plutôt que d'inclure le header et le footer manuellement dans chaque fichier de vue ?

**Réponse :** `@extends` permet de centraliser la structure commune (DOCTYPE, `<head>`, navbar, footer) dans un seul layout. Toutes les pages enfants ne contiennent que leur contenu spécifique via `@section`. Si on copiait le header et le footer dans chaque fichier avec `@include`, on dupliquerait la logique de mise en page : toute modification (logo, menu, CSS) devrait être répétée partout, avec un risque d'oubli et d'incohérence. `@extends` respecte le principe DRY (Don't Repeat Yourself) et rend la maintenance plus simple.

3. Comment s'assure-t-on qu'une vue du dashboard n'étende jamais accidentellement le layout public ?

**Réponse :** On applique une convention stricte : les vues du dashboard sont placées dans `resources/views/dashboard/` et utilisent systématiquement `@extends('dashboard')`, tandis que les vues publiques sont dans `resources/views/public/` et utilisent `@extends('app')`. On peut aussi vérifier visuellement ou en revue de code que aucun fichier du dossier `dashboard/` n'appelle `@extends('app')`. En production, on pourrait ajouter un contrôle (commentaire, règle de nommage ou test) pour garantir cette séparation.

---

### Question 2 — Assets & Composants de la partie publique

1. Déplacez le fichier `index.css` dans le dossier `public/css/`.
2. Référencez-le dans vos layouts en utilisant la fonction **`asset()`** de Laravel.
3. Créez deux **composants Blade anonymes** :
   - `resources/views/components/header.blade.php`
   - `resources/views/components/footer.blade.php`
4. Incluez ces composants dans le layout public en utilisant la syntaxe `@include()`.


---

### Question 3 — Assets & Composants du dashboard

1. Déplacez le fichier `Dashboard.css` dans le dossier `public/css/`.
2. Référencez-le dans vos layouts en utilisant la fonction **`asset()`**.
3. Créez deux composants Blade pour le dashboard :
   - `resources/views/components/dashboard/topbar.blade.php`
   - `resources/views/components/dashboard/sidebar.blade.php`
4. Incluez ces composants dans `Dashboard.blade.php`.

**Questions :**

1. Comment rendre la classe `active` d'un lien de la sidebar **dynamique** selon la route courante, en utilisant `request()->routeIs()` ou `Route::currentRouteName()` ?

**Réponse :** On compare la route actuelle au nom de la route du lien. Avec `request()->routeIs()`, on peut tester une route précise ou un motif :

```blade
<a href="{{ route('dashboard.articles') }}"
   class="nav-item {{ request()->routeIs('dashboard.articles') ? 'active' : '' }}">
    Articles
</a>
```

Le joker `*` permet de cibler plusieurs routes : `request()->routeIs('dashboard.*')`. Avec `Route::currentRouteName()`, on compare directement le nom :

```blade
class="nav-item {{ Route::currentRouteName() === 'dashboard.articles' ? 'active' : '' }}"
```

Si la condition est vraie, la classe CSS `active` est ajoutée au lien correspondant à la page visitée.

2. Pourquoi est-il préférable de placer les composants du dashboard dans un sous-dossier `components/dashboard/` plutôt que directement dans `components/` ?

**Réponse :** Cela organise le projet par contexte (public vs administration). On évite les conflits de noms (par exemple un `header.blade.php` public et un autre pour l'admin), on retrouve plus vite les fichiers liés au dashboard, et l'arborescence reflète la structure de l'application. L'inclusion devient explicite : `@include('components.dashboard.sidebar')` indique clairement qu'il s'agit d'un composant réservé à l'admin.

---

### Question 4 — Création des routes

Dans le fichier `routes/web.php`, déclarez une route nommée pour chacune des vues suivantes :

**Partie publique :**

| URL | Nom de la route | Description |
|---|---|---|
| `/` | `home` | Page d'accueil |
| `/articles` | `articles.index` | Liste des articles |
| `/articles/{slug}` | `articles.show` | Détail d'un article |
| `/categories` | `categories.index` | Liste des catégories |
| `/about` | `about` | Page à propos |

**Questions :**

1. Quelle est la différence entre `Route::get()` et `Route::post()` ? Dans quel cas utilise-t-on l'un plutôt que l'autre ?

**Réponse :** `Route::get()` enregistre une route accessible par la méthode HTTP **GET** : elle sert à **lire** ou **afficher** une ressource (page HTML, liste, formulaire vide). `Route::post()` enregistre une route pour la méthode **POST** : elle sert à **envoyer des données** au serveur (soumission de formulaire, création en base). On utilise GET pour consulter une page et POST pour traiter une action qui modifie des données (créer un article, se connecter, etc.).

2. Comment déclarer et nommer une route avec la méthode `->name()` ? Pourquoi les noms de routes sont-ils indispensables pour utiliser `route()` dans les vues Blade ?

**Réponse :** On chaîne `->name()` après la définition de la route :

```php
Route::get('/articles', [MainController::class, 'articles'])->name('articles.index');
```

Le nom `articles.index` identifie cette route de façon unique. Dans Blade, `route('articles.index')` génère automatiquement l'URL correcte (`/articles`). Les noms sont indispensables car ils découplent les vues des URLs : si l'URL change dans `web.php`, tous les liens `route(...)` restent valides sans modifier chaque fichier Blade.

3. Qu'est-ce qu'un paramètre de route dynamique comme `{id}` ? Comment le récupérer dans le contrôleur ?

**Réponse :** Un segment entre accolades (ex. `{slug}`, `{id}`) est une partie variable de l'URL. Pour `/articles/mon-article`, le segment `mon-article` est capturé. Laravel l'injecte dans le paramètre de même nom de la méthode du contrôleur :

```php
public function article(string $slug)
{
    // $slug vaut "mon-article"
    return view('public.article', compact('slug'));
}
```

Le nom du paramètre dans l'URL et dans la méthode doit correspondre (`{slug}` → `$slug`).

4. Que se passe-t-il si deux routes ont la même URL mais des méthodes HTTP différentes (`GET` et `POST`) ?

**Réponse :** Laravel les considère comme **deux routes distinctes**. Le routeur choisit celle qui correspond à la méthode HTTP de la requête : un GET sur `/articles` exécute la route GET, un POST sur `/articles` exécute la route POST. C'est le principe REST : même URL, actions différentes selon le verbe HTTP (ex. GET = afficher le formulaire, POST = enregistrer les données).

---

### Question 5 — Groupement des routes du dashboard

Créez un **groupe de routes** pour toutes les pages du dashboard en utilisant `Route::prefix()` et `->group()`.

Toutes les routes du dashboard doivent :
- Avoir le **préfixe d'URL** `/dashboard`
- Avoir le **préfixe de nom** `dashboard.`
- Pointer vers les méthodes de `DashboardController`

Exemple de routes attendues :

| URL | Nom de la route | Méthode du contrôleur |
|---|---|---|
| `/dashboard` | `dashboard.index` | `index` |
| `/dashboard/articles` | `dashboard.articles` | `articles` |
| `/dashboard/categories` | `dashboard.categories` | `categories` |
| `/dashboard/utilisateurs` | `dashboard.users` | `users` |
| `/dashboard/commentaires` | `dashboard.comments` | `comments` |
| `/dashboard/reglages` | `dashboard.settings` | `settings` |

**Questions :**

1. Quelle est la syntaxe complète pour créer un groupe de routes avec un préfixe d'URL et un préfixe de nom en même temps ?

**Réponse :**

```php
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/articles', [DashboardController::class, 'articles'])->name('articles');
});
```

- `prefix('dashboard')` : toutes les URL du groupe commencent par `/dashboard` (ex. `/dashboard/articles`).
- `name('dashboard.')` : tous les noms de routes du groupe sont préfixés par `dashboard.` (ex. `dashboard.index`, `dashboard.articles`).
- `group(function () { ... })` : regroupe les routes qui partagent ces préfixes.

2. Quelle est la différence entre `Route::prefix()` et `Route::middleware()` dans un groupe de routes ?

**Réponse :** `Route::prefix()` ajoute un **segment d'URL** commun à toutes les routes du groupe (ici `/dashboard`). `Route::middleware()` applique un ou plusieurs **filtres** (middleware) à toutes les routes du groupe avant d'exécuter le contrôleur — par exemple `auth` pour exiger une connexion, ou `admin` pour restreindre l'accès. Le prefix modifie l'adresse ; le middleware modifie les conditions d'accès et le traitement de la requête.

3. Qu'est-ce que `Route::resource()` ? Pour quelles ressources (articles, catégories, utilisateurs) serait-il pertinent de l'utiliser et quelles routes génère-t-il automatiquement ?

**Réponse :** `Route::resource('articles', ArticleController::class)` génère automatiquement les **7 routes CRUD** standard :

| Méthode HTTP | URI | Nom de route | Action | Rôle |
|---|---|---|---|---|
| GET | `/articles` | `articles.index` | `index` | Liste |
| GET | `/articles/create` | `articles.create` | `create` | Formulaire de création |
| POST | `/articles` | `articles.store` | `store` | Enregistrer |
| GET | `/articles/{article}` | `articles.show` | `show` | Détail |
| GET | `/articles/{article}/edit` | `articles.edit` | `edit` | Formulaire d'édition |
| PUT/PATCH | `/articles/{article}` | `articles.update` | `update` | Mettre à jour |
| DELETE | `/articles/{article}` | `articles.destroy` | `destroy` | Supprimer |

C'est pertinent pour **articles**, **catégories** et **utilisateurs** dans le dashboard, car ce sont des ressources qu'on crée, lit, modifie et supprime. Pour des pages simples (accueil dashboard, réglages), une route GET nommée suffit.

---

### Question 6 — Création des contrôleurs

Générez les deux contrôleurs suivants via la commande `php artisan make:controller` :

**`MainController`** — gérera toutes les vues publiques :
- `index()` → vue de la page d'accueil
- `articles()` → vue de la liste des articles
- `article($slug)` → vue du détail d'un article
- `categories()` → vue de la liste des catégories
- `about()` → vue de la page à propos

**`DashboardController`** — gérera toutes les vues du dashboard :
- `index()` → vue principale du dashboard
- `articles()` → vue des articles (admin)
- `categories()` → vue des catégories (admin)
- `users()` → vue des utilisateurs
- `comments()` → vue des commentaires
- `settings()` → vue des réglages

Chaque méthode doit retourner sa vue correspondante avec `return view('...')`.

**Questions :**

1. Quelle est la commande artisan pour générer un contrôleur ? Quelle option ajouter pour générer directement un **contrôleur de ressource** avec toutes les méthodes CRUD ?

**Réponse :** Pour un contrôleur simple :

```bash
php artisan make:controller MainController
```

Pour un contrôleur de ressource avec les 7 méthodes CRUD (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`) :

```bash
php artisan make:controller ArticleController --resource
```

(ou l'option longue `--resource` après le nom du contrôleur).

2. Quelle est la convention de nommage des méthodes d'un contrôleur de ressource Laravel (`index`, `show`, `create`, `store`, `edit`, `update`, `destroy`) ? À quelle action correspond chacune ?

**Réponse :**

| Méthode | Action |
|---|---|
| `index` | Afficher la **liste** de toutes les ressources |
| `create` | Afficher le **formulaire** de création |
| `store` | **Enregistrer** une nouvelle ressource (POST) |
| `show` | Afficher le **détail** d'une ressource |
| `edit` | Afficher le **formulaire** d'édition |
| `update` | **Mettre à jour** une ressource existante (PUT/PATCH) |
| `destroy` | **Supprimer** une ressource (DELETE) |

3. Quelle est la différence entre ces trois façons de passer des données à une vue depuis un contrôleur ?
   ```php
   return view('articles', ['posts' => $posts]);
   return view('articles', compact('posts'));
   return view('articles')->with('posts', $posts);
   ```

**Réponse :** Les trois syntaxes envoient la variable `$posts` à la vue `articles` ; seule la forme d'écriture change.

- `view('articles', ['posts' => $posts])` : passe un **tableau associatif** explicite (clé => valeur).
- `view('articles', compact('posts'))` : `compact('posts')` construit le même tableau `['posts' => $posts]` à partir du nom de variable — plus court quand on a plusieurs variables.
- `view('articles')->with('posts', $posts)` : chaînage fluide ; on peut enchaîner plusieurs `->with('cle', $valeur)`.

Le résultat dans la vue est identique : `$posts` est utilisable dans le Blade.

---

### Question 7 — Liens et navigation

Sont concernés (liste non exhaustive) :
- Les liens de la navbar publique (Accueil, Articles, Catégories, À propos)
- Les liens de la sidebar du dashboard (Dashboard, Articles, Catégories, Utilisateurs, Commentaires, Réglages)
- Le lien « Voir le blog » dans la topbar du dashboard
- Le lien « Dashboard / Admin » dans le footer public
- Les liens « Voir tout → » sur la page d'accueil
- Les liens sur les cartes d'articles (qui mènent vers le détail d'un article)
- Le breadcrumb sur la page article
- Le bouton « ↗ Voir le blog » dans le dashboard

---

## 📁 Structure de fichiers attendue

À la fin de l'évaluation, votre projet doit respecter l'arborescence suivante :

```
resources/
└── views/
    ├── app.blade.php       ← Layout partie publique
    ├── dashboard.blade.php ← Layout dashboard
    ├── components/
    │   ├── header.blade.php           ← Header public
    │   ├── footer.blade.php           ← Footer public
    │   └── dashboard/
    │       ├── topbar.blade.php       ← Topbar dashboard
    │       └── sidebar.blade.php      ← Sidebar dashboard
    ├── public/                        ← Vues publiques
    │   ├── index.blade.php
    │   ├── articles.blade.php
    │   ├── article.blade.php
    │   ├── categories.blade.php
    │   └── about.blade.php
    └── dashboard/                     ← Vues dashboard
        ├── index.blade.php
        ├── articles.blade.php
        ├── categories.blade.php
        ├── users.blade.php
        ├── comments.blade.php
        └── settings.blade.php

app/
└── Http/
    └── Controllers/
        ├── MainController.php
        └── DashboardController.php

public/
└── css/
    ├── public.css
    └── dashboard.css

routes/
└── web.php
```

---

## Critères d'évaluation

| Critère | Points |
|---|---|
| Layouts Blade corrects avec `@extends`, `@yield`, `@section` | 3 pts |
| Composants publics (header, footer) fonctionnels avec `asset()` | 3 pts |
| Composants dashboard (topbar, sidebar) fonctionnels avec `asset()` | 3 pts |
| Routes publiques nommées et correctement déclarées | 3 pts |
| Routes dashboard groupées avec préfixe et nommage cohérent | 3 pts |
| Contrôleurs créés avec les bonnes méthodes et retours de vues | 3 pts |
| Liens Blade partout | 4 pts |
| Réponses aux questions théoriques | 8 pts |
| **Total** | **30 pts** |

---

## Consignes générales

- Le travail est **individuel**.
- Soumettez votre travail en poussant votre code sur un dépôt GitHub **personnel** et en partageant le lien.
- Le dépôt doit contenir un fichier `.env.example` à jour mais **jamais** le fichier `.env` lui-même.
- Toute ressemblance de code entre deux rendus entraînera un **zéro** pour les deux parties concernées.
- Les réponses aux questions théoriques sont à rédiger directement dans ce fichier `README.md`, sous chaque question.

**Bonne évaluation !**
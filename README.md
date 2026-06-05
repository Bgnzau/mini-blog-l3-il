# Évaluation — Mini Blog Laravel / Blade — Partie 2

**Module :** Développement Web avec Laravel
**Niveau :** L3 — Informatique et Logiciels
**Dépôt GitHub :** [Dr-Lab1/mini-blog-l3-il-part2](https://github.com/Dr-Lab1/mini-blog-l3-il-part2)

---

## Mise en place du projet

Avant de commencer l'évaluation, effectuez les étapes suivantes dans l'ordre :

```bash
# 1. Cloner le dépôt GitHub
git clone https://github.com/Dr-Lab1/mini-blog-l3-il-part2.git

# 2. Se déplacer dans le répertoire du projet
cd mini-blog-l3-il-part2

# 3. Installer les dépendances PHP
composer install

# 4. Copier le fichier d'environnement
cp .env.example .env

# 5. Générer la clé de l'application
php artisan key:generate

# 6. Configurer la base de données dans le fichier .env
# puis exécuter les migrations et les seeders
php artisan migrate --seed

# 7. Exécuter cette commande pour install Laravel Breeze
composer require laravel/breeze --dev
```

> Assurez-vous d'avoir un **PHP 8+**, **Composer** et **Laravel** compatibles installés sur votre machine avant de commencer.

---

## Travail à réaliser

> **Note préliminaire :** Créez vos propres relations Eloquent entre les modèles si vous les jugez nécessaires pour réaliser les tâches ci-dessous.

---

### Question 1 — Page d'accueil

Dynamisez la page d'accueil en récupérant les données réelles depuis la base de données.

**Tâches :**

1. Afficher les **3 derniers articles** dans la section des articles mis en avant.

   ```php
   $articles = Post::limit(3)->orderByDesc('id')->get();
   // Récupère les 3 derniers articles dans l'ordre décroissant
   ```

2. Afficher **5 catégories** dans la section des catégories.

   ```php
   $categories = Category::limit(5)->get();
   // Récupère les 5 premières catégories dans l'ordre croissant
   ```

3. Afficher les **statistiques réelles** (nombre total d'articles, de catégories et de commentaires) dans la section des stats de la page d'accueil.

**Questions :**

1. Comment passe-t-on plusieurs variables à une vue depuis un contrôleur en une seule instruction ?

> On utilise généralement la fonction native `compact()`. Elle prend en paramètres les noms des variables sous forme de chaînes de caractères (sans le signe `$`) et crée un tableau associatif. 
> *Exemple :* `return view('public.index', compact('articles', 'categories'));`
> Alternativement, on peut passer un tableau associatif directement : `return view('public.index', ['articles' => $articles]);`


2. Dans la vue Blade, comment affiche-t-on la valeur d'une variable avec protection contre les failles XSS ?

> On utilise la syntaxe des doubles accolades : `{{ $variable }}`. En arrière-plan, Laravel applique automatiquement la fonction PHP `htmlspecialchars()` sur la donnée, ce qui neutralise et transforme tout code HTML ou JavaScript malveillant en texte inoffensif avant l'affichage.


3. Qu'est-ce que la directive `@foreach` en Blade et comment l'utilise-t-on pour afficher une liste d'articles ?

> La directive `@foreach` est une structure de contrôle propre à Blade qui simplifie l'écriture des boucles PHP `foreach`. Elle permet de parcourir une collection de données (comme un tableau d'articles) pour répéter un bloc de code HTML pour chaque élément.
> *Exemple d'utilisation :*
> ```blade
> @foreach($articles as $article)
>     <div class="article-card">
>         <h3>{{ $article->title }}</h3>
>     </div>
> @endforeach
> ```


---

### Question 2 — Page Articles (publique)

Dynamisez la page de liste des articles.

**Tâches :**

1. N'afficher que les **10 derniers articles** dans la liste.

   ```php
   $articles = Post::limit(10)->orderByDesc('id')->get();
   ```

2. Remplacer le texte statique *"50 articles publiés dans 5 catégories"* par les **chiffres réels** issus de la base de données.

3. Afficher le **nombre total d'articles** et le **nombre total de catégories** dans la barre de statistiques de la page.

4. Dynamiser la section d'affichage des **catégories dans la sidebar** ou le filtre de la page.

**Questions :**

1. Quelle est la différence entre `Post::all()` et `Post::limit(10)->orderByDesc('id')->get()` ? Quand préfère-t-on l'une ou l'autre ?

> * `Post::all()` récupère **l'intégralité** des enregistrements de la table sans aucun filtre ni tri (par ordre d'insertion chronologique). On l'utilise uniquement pour les petites tables (comme une liste fixe de catégories).
> * `Post::limit(10)->orderByDesc('id')->get()` trie les articles du plus récent au plus ancien et n'en récupère **que 10 maximum**. On la préfère largement pour les tables volumineuses (articles, commentaires) afin de préserver la mémoire du serveur et optimiser les performances.


2. Comment compte-t-on le nombre total d'enregistrements d'un modèle en Eloquent ?

> On utilise la méthode de calcul native d'Eloquent `count()`. 
> *Exemple :* `$totalArticles = Post::count();` (cela exécute une requête SQL optimisée de type `SELECT COUNT(*) FROM posts`).


3. Comment utilise-t-on `@forelse` en Blade et en quoi est-il plus pratique que `@foreach` lorsqu'une collection peut être vide ?

> La directive `@forelse` combine une boucle `@foreach` et une condition de vérification d'existence (`if/else`) en une seule structure. Si la collection contient des éléments, elle les parcourt. Si elle est vide, elle bascule automatiquement sur le bloc `@empty`. Elle évite de devoir écrire manuellement un `@if(count($articles) > 0)` autour d'un `@foreach`.
> *Exemple :*
> ```blade
> @forelse($articles as $article)
>     <li>{{ $article->title }}</li>
> @empty
>     <p>Aucun article disponible pour le moment.</p>
> @endforelse
> ```


---

### Question 3 — Page Catégories (publique)

Dynamisez la page des catégories.

**Tâches :**

1. Afficher **toutes les catégories** avec, pour chacune, son **nombre d'articles** associés.

**Questions :**

1. Comment définit-on une relation `hasMany` entre un modèle `Category` et un modèle `Post` en Eloquent ?

> Dans le modèle `Category.php`, on crée une méthode au pluriel `posts()` qui retourne l'instruction `$this->hasMany(Post::class);`. Cela indique à Laravel qu'une seule catégorie possède plusieurs articles liés par une clé étrangère (généralement `category_id`).


2. Comment accède-t-on au nombre d'articles d'une catégorie dans une vue Blade — quelle est la différence entre `$category->posts->count()` et `$category->posts()->count()` ?

> * `$category->posts->count()` : Accède à la **propriété dynamique**. Laravel charge d'abord *tous* les articles de la catégorie en mémoire sous forme de collection PHP, puis compte le nombre d'éléments. C'est lourd si la catégorie a des milliers d'articles.
> * `$category->posts()->count()` : Accède à la **méthode de relation**. On ajoute des parenthèses pour obtenir une instance du constructeur de requêtes SQL. Laravel exécute une requête directe `COUNT(*)` en base de données, ce qui est beaucoup plus rapide et économe en mémoire.


3. Qu'est-ce que le **chargement eager** (`with()`) et pourquoi est-il important pour éviter le problème des requêtes N+1 lors de l'affichage des catégories avec leur nombre d'articles ?

> Le chargement "eager" (ou chargement anticipé) consiste à utiliser la méthode `with()` lors de la requête SQL initiale pour récupérer un modèle et ses relations en seulement deux requêtes distinctes (ex: `Category::with('posts')->get()`). 
> Sans `with()`, Laravel fait du "lazy loading" : il exécute 1 requête pour lister les catégories, puis ré-exécute **1 requête supplémentaire pour chaque catégorie (N)** afin de compter ses articles. Pour 50 catégories, cela fait 51 requêtes (problème des requêtes N+1), ce qui ralentit considérablement le site.


---

### Question 4 — Page À propos (publique)

Dynamisez la page à propos.

**Tâches :**

1. Afficher les **statistiques réelles** (nombre total d'articles, de catégories, d'utilisateurs ou de commentaires) dans la section statistiques.

2. Lister **tous les utilisateurs** dans la section équipe.

   ```php
   $users = User::all();
   ```

**Questions :**

1. Le modèle `User` existe déjà par défaut dans Laravel — dans quel fichier se trouve-t-il et quels attributs contient-il par défaut ?

> Le modèle se trouve dans le fichier `app/Models/User.php`. Par défaut, il contient des attributs standards pour gérer l'identité et la sécurité : `id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, et `updated_at`.


2. Comment affiche-t-on conditionnellement un élément dans Blade — par exemple, n'afficher la liste des utilisateurs que si elle n'est pas vide ?

> On utilise la directive conditionnelle `@if` couplée à la méthode `@isNotEmpty()` ou à la fonction `count()`.
> *Exemple :*
> ```blade
> @if($users->isNotEmpty())
>     > @endif
> ```


3. Qu'est-ce que la directive `@empty` en Blade ?

> La directive `@empty` peut s'utiliser de deux manières :
> 1. Seule, comme une condition : `@empty($variable)` vérifie si une variable est considérée comme vide (similaire à la fonction PHP `empty()`).
> 2. Associée à la directive `@forelse` : elle marque le bloc de code alternatif à exécuter si la collection parcourue ne contient aucun enregistrement.



---

### Question 5 — Dashboard — Page Index

Dynamisez la page principale du tableau de bord.

**Tâches :**

1. Afficher les **statistiques réelles** dans les 4 cartes de statistiques (nombre d'articles, commentaires, utilisateurs, catégories).

2. Afficher les **7 derniers articles** dans le tableau de la section "Articles récents".

**Questions :**

1. Comment récupérer les 7 derniers articles insérés en base de données avec Eloquent ?

> On combine le tri décroissant sur l'identifiant avec une limite stricte de 7 résultats.
> *Syntaxe :* `Post::orderByDesc('id')->limit(7)->get();` (ou en utilisant le raccourci `Post::latest()->take(7)->get();`).


2. Comment accède-t-on à une colonne spécifique d'un objet Eloquent dans une vue Blade — par exemple le titre d'un article ?

> On utilise l'opérateur fléché `->` sur l'instance de l'objet suivi du nom exact de la colonne dans la base de données.
> *Exemple :* `{{ $article->title }}`


3. Qu'est-ce que `$article->created_at` et comment le formater dans une vue Blade pour afficher une date lisible ?

> `$article->created_at` est une instance de l'objet **Carbon** (la bibliothèque de gestion des dates de Laravel) représentant la date et l'heure de création de l'enregistrement. Pour l'afficher de manière lisible (ex: jour/mois/année), on utilise sa méthode `format()`.
> *Exemple :* `{{ $article->created_at->format('d/m/Y') }}`


---

### Question 6 — Dashboard — Articles

Dynamisez la page de gestion des articles dans le dashboard.

**Tâches :**

1. Afficher les **10 derniers articles** dans le tableau, avec pour chaque article : son titre, sa catégorie, son statut (publié ou brouillon), sa date de publication et son auteur.

**Questions :**

1. Comment récupérer les articles **avec leur catégorie associée** en une seule requête Eloquent (sans faire de requête supplémentaire pour chaque article) ?

> On applique le chargement "eager loading" grâce à la méthode `with()`.
> *Syntaxe :* `Post::with('category')->latest()->limit(10)->get();`


2. Comment affiche-t-on le nom de la catégorie d'un article dans Blade si la relation `belongsTo` est définie sur le modèle `Post` ?

> On passe d'abord par la relation pour atteindre l'objet lié, puis on pointe sur la colonne de son nom.
> *Exemple :* `{{ $article->category->name }}` (en utilisant l'opérateur "null-safe" `{{ $article->category?->name }}` pour éviter un crash si un article n'a plus de catégorie).


3. Qu'est-ce qu'un **accesseur** (`get...Attribute`) en Eloquent et dans quel cas pourrait-il être utile ici ?

> Un accesseur est une méthode définie dans un modèle qui permet de formater ou de créer une propriété virtuelle à la volée lors de la récupération d'une donnée. 
> *Utilité ici :* Par exemple, créer un accesseur pour formater le statut en HTML selon sa valeur (renvoyer un badge vert si "publié", ou un badge gris si "brouillon"), ou pour fusionner le prénom et le nom d'un auteur.


---

### Question 7 — Dashboard — Catégories, Commentaires & Utilisateurs

Dynamisez les trois pages de gestion restantes du dashboard.

**Tâches :**

1. **Catégories** — Afficher toutes les catégories dans le tableau.
2. **Commentaires** — Afficher tous les commentaires dans la liste, avec pour chacun : son auteur, le titre de l'article concerné et sa date.
3. **Utilisateurs** — Afficher tous les utilisateurs dans le tableau.

**Questions :**

1. Comment définit-on une relation `belongsTo` entre un commentaire et un article en Eloquent ?

> Dans le modèle `Comment.php`, on définit une méthode au singulier `post()` qui renvoie l'instruction `$this->belongsTo(Post::class);`. Cela indique que chaque commentaire est rattaché hiérarchiquement à un seul article spécifique via la clé `post_id`.


2. Dans la page des commentaires, comment affiche-t-on le titre de l'article auquel appartient un commentaire, en supposant que la relation est correctement définie ?

> On accède à la relation `post` définie sur le modèle Comment, puis à l'attribut `title` de l'article.
> *Exemple :* `{{ $comment->post?->title }}`


3. Quelle méthode Eloquent utilise-t-on pour récupérer **tous** les enregistrements d'une table sans condition ?

> On utilise la méthode statique `all()`.
> *Exemple :* `User::all();` ou `Category::all();`


---

## Structure de fichiers concernés

Les fichiers que vous serez principalement amenés à modifier :

```
app/
├── Models/
│   ├── Post.php          ← Ajouter les relations si nécessaire
│   ├── Category.php      ← Ajouter les relations si nécessaire
│   ├── Comment.php       ← Ajouter les relations si nécessaire
│   └── User.php          ← Modèle existant
└── Http/
    └── Controllers/
        ├── MainController.php       ← Passer les données aux vues publiques
        └── DashboardController.php  ← Passer les données aux vues du dashboard

resources/views/
├── public/
│   ├── index.blade.php        ← Dynamiser
│   ├── articles.blade.php     ← Dynamiser
│   ├── categories.blade.php   ← Dynamiser
│   └── about.blade.php        ← Dynamiser
└── dashboard/
    ├── index.blade.php        ← Dynamiser
    ├── articles.blade.php     ← Dynamiser
    ├── categories.blade.php   ← Dynamiser
    ├── comments.blade.php     ← Dynamiser
    └── users.blade.php        ← Dynamiser
```

---

## Critères d'évaluation

| Critère | Points |
|---|---|
| Page d'accueil dynamisée (articles, catégories, stats) | 1.5 pt |
| Page articles dynamisée (liste, stats, catégories) | 1.5 pt |
| Page catégories dynamisée (liste + nombre d'articles) | 1 pt |
| Page à propos dynamisée (stats + utilisateurs) | 1 pt |
| Dashboard — Index dynamisé (stats + 7 derniers articles) | 1.5 pt |
| Dashboard — Articles dynamisé (10 derniers) | 1 pt |
| Dashboard — Catégories, Commentaires, Utilisateurs dynamisés | 1 pt |
| Réponses aux questions théoriques | 1.5 pt |
| **Total** | **10 pts** |

---

## Consignes générales

- Le travail est **individuel**.
- Soumettez votre travail en poussant votre code sur un dépôt GitHub **personnel** et en partageant le lien.
- Le dépôt doit contenir un fichier `.env.example` à jour mais **jamais** le fichier `.env` lui-même.
- Toute ressemblance de code entre deux rendus entraînera un **zéro** pour les deux parties concernées.
- Les réponses aux questions théoriques sont à rédiger directement dans ce fichier `README.md`, sous chaque question.

**Bonne évaluation !**
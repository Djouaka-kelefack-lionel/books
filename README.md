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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



# Application de Gestion de Livres

Une application web permettant de gérer une bibliothèque de livres avec système de likes/dislikes.

## Table des matières
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Fonctionnalités](#fonctionnalités)
- [Structure de la Base de Données](#structure-de-la-base-de-données)
- [API Routes](#api-routes)
- [Utilisation](#utilisation)

## Prérequis

- PHP 8.1 ou supérieur
- Composer
- MySQL 5.7 ou supérieur
- Node.js et NPM
- Git


## **Installation**

Suivez ces étapes pour configurer le projet Laravel localement.

---

### **1. Clonez le repository**
Exécutez les commandes suivantes pour cloner le projet et naviguer dans son répertoire :

```bash
git clone [URL_DU_REPO]
cd books
```

---

### **2. Installez les dépendances PHP**
Assurez-vous d’avoir **PHP** et **Composer** installés sur votre système. Ensuite, installez les dépendances du projet :

```bash
composer install
```

---

### **3. Installez les dépendances JavaScript**
Ce projet utilise des outils frontend basés sur Node.js. Installez les dépendances JavaScript et générez les assets frontend :

```bash
npm install
npm run dev
```

---

### **4. Configurez l'environnement**
Créez une copie du fichier `.env.example` et renommez-la `.env` :

```bash
cp .env.example .env
```

Ensuite, ouvrez le fichier `.env` et configurez les paramètres nécessaires (comme la base de données, Firebase, etc.).

---

### **5. Générez la clé de l'application**
Laravel nécessite une clé unique pour sécuriser les sessions et autres données. Générez-la avec la commande suivante :

```bash
php artisan key:generate
```

---

### **6. Configurez la base de données**
1. Configurez les informations de votre base de données dans le fichier `.env` :
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=books
   DB_USERNAME=root
   DB_PASSWORD=secret
   ```

2. Exécutez les migrations pour créer les tables nécessaires :
   ```bash
   php artisan migrate
   ```

---

### **7. Lancez le serveur de développement**
Pour démarrer l'application localement, utilisez la commande suivante :

```bash
php artisan serve
```

L'application sera accessible à l'adresse [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

Voici une version améliorée et mieux formatée de la section **Configuration** pour le fichier `README.md` :

---

## **Configuration**

Suivez ces étapes pour configurer correctement votre environnement.

---

### **1. Configurez la base de données**
Modifiez le fichier `.env` pour y ajouter les informations de votre base de données. Voici un exemple de configuration pour MySQL :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=books
DB_USERNAME=votre_username
DB_PASSWORD=votre_password
```

- **DB_HOST** : Adresse de votre serveur de base de données (par défaut : `127.0.0.1` pour un serveur local).
- **DB_PORT** : Port de la base de données (par défaut : `3306` pour MySQL).
- **DB_DATABASE** : Nom de la base de données (par exemple : `books`).
- **DB_USERNAME** : Nom d’utilisateur de la base de données.
- **DB_PASSWORD** : Mot de passe de la base de données.

Assurez-vous que la base de données définie dans `DB_DATABASE` existe avant de lancer les migrations.

---

### **2. Exécutez les migrations**
Les migrations permettent de créer automatiquement les tables nécessaires dans votre base de données. Pour lancer les migrations, exécutez la commande suivante :

```bash
php artisan migrate
```

Une fois les migrations terminées, les tables nécessaires seront créées dans votre base de données.

---


## Fonctionnalités

### Gestion des Livres
- Création d'un nouveau livre
- Modification des informations d'un livre
- Suppression d'un livre
- Affichage de la liste des livres
- Recherche de livres
- Filtrage par catégorie

### Système de Likes/Dislikes
- Like/Dislike sur les livres
- Un utilisateur peut :
  - Ajouter un like ou dislike
  - Changer son vote
  - Retirer son vote
- Compteurs en temps réel des likes/dislikes

### Interface Utilisateur
- Design responsive
- Navigation intuitive
- Feedback visuel des actions
- Mise à jour dynamique des compteurs


---

## **Administration**

L'administration permet de gérer les utilisateurs, les livres, et d'accéder à des fonctionnalités avancées pour le contrôle et la maintenance de l'application.

---

### **1. Accès à l'Administration**
- **URL** : `/admin`
- **Connexion** : 
  - Requiert des identifiants administrateurs.
  - Redirection automatique vers la page de connexion si non authentifié.
  
---

### **2. Création d'un Compte Administrateur**
Pour créer un compte administrateur via la ligne de commande, utilisez la commande suivante :

```bash
php artisan make:admin
```

Cette commande vous guidera à travers la création d’un compte avec les champs nécessaires, tels que :
- **Nom d'utilisateur**
- **Email**
- **Mot de passe**
- **Rôle** (Super Admin, Modérateur, Éditeur)

---

### **3. Fonctionnalités Administratives**

#### **Gestion des Utilisateurs**
- Ajouter, modifier ou supprimer des comptes administrateurs.
- Gérer les permissions pour différents rôles administratifs.
- Visualiser et auditer les logs de connexion des administrateurs.

#### **Gestion des Livres**
- Afficher une vue d’ensemble de tous les livres enregistrés.
- Valider ou rejeter les nouveaux livres soumis par les utilisateurs.
- Modifier ou supprimer des livres individuellement ou en masse.
- Organiser les livres par catégories.
- Accéder à des statistiques détaillées comme :
  - Nombre de likes/dislikes par livre.
  - Tendances sur les livres les plus consultés.

#### **Tableau de Bord**
- Statistiques globales :
  - Total des livres disponibles.
  - Activité des likes/dislikes sur les livres.
  - Liste des livres les plus populaires.
- Graphiques et rapports d’activité (par exemple : activité hebdomadaire).
- Export des données en CSV ou PDF.

#### **Modération**
- Surveiller et analyser les activités suspectes (ex. : spams ou abus).
- Bloquer les sessions d’utilisateurs malveillants.
- Consulter l’historique des actions de modération.

---

### **4. Rôles et Permissions**
La gestion des rôles et permissions permet de définir clairement les responsabilités des différents administrateurs.

- **Super Admin** : 
  - Accès complet à toutes les fonctionnalités.
  - Gestion des rôles et permissions.
- **Modérateur** :
  - Peut modérer les commentaires et les livres.
  - Pas d'accès à la gestion des utilisateurs ni aux paramètres système.
- **Éditeur** :
  - Responsable de l’ajout, de la modification et de la suppression du contenu.
  - Pas d'accès à la modération ou à la gestion des utilisateurs.

---

### **5. Sécurité Administrative**
L'administration inclut des fonctionnalités pour garantir la sécurité et l'intégrité des données :
- **Authentification à deux facteurs (2FA)** : Ajoute une couche supplémentaire de sécurité pour les connexions administratives.
- **Journal des actions administratives** : 
  - Enregistre les actions critiques (ex. : suppression d’un livre, modification des permissions).
  - Traçabilité complète des modifications.
- **Restrictions IP** (optionnel) : Limitez l'accès à l'interface d'administration à des plages IP spécifiques.
- **Sessions sécurisées** : Déconnexion automatique en cas d’inactivité prolongée.


---

## **Structure de la Base de Données**

Voici la structure des tables principales utilisées dans l'application.

---

### **1. Table `books`**
Cette table stocke les informations principales des livres.

| **Colonne**      | **Type**       | **Description**                                    |
|-------------------|----------------|----------------------------------------------------|
| `id`             | BIGINT (PK)    | Identifiant unique du livre.                      |
| `title`          | VARCHAR(255)   | Titre du livre.                                   |
| `description`    | TEXT           | Description ou résumé du livre.                  |
| `author`         | VARCHAR(255)   | Nom de l’auteur du livre.                         |
| `likes_count`    | INTEGER        | Nombre total de likes pour le livre (cache).      |
| `dislikes_count` | INTEGER        | Nombre total de dislikes pour le livre (cache).   |
| `created_at`     | TIMESTAMP      | Date de création du livre.                       |
| `updated_at`     | TIMESTAMP      | Dernière date de mise à jour des informations.    |

#### **Relations**
- Chaque livre peut recevoir plusieurs likes ou dislikes (relation avec la table `likes`).
- Les champs `likes_count` et `dislikes_count` servent de cache pour améliorer les performances.

---

### **2. Table `likes`**
Cette table gère les interactions utilisateur (likes et dislikes).

| **Colonne**      | **Type**       | **Description**                                    |
|-------------------|----------------|----------------------------------------------------|
| `id`             | BIGINT (PK)    | Identifiant unique du like/dislike.               |
| `book_id`        | BIGINT (FK)    | Identifiant du livre associé (relation avec `books`). |
| `session_id`     | VARCHAR(255)   | Identifiant unique de session pour éviter les doublons. |
| `type`           | ENUM('like', 'dislike') | Type d’interaction (like ou dislike).        |
| `created_at`     | TIMESTAMP      | Date à laquelle le like/dislike a été enregistré. |
| `updated_at`     | TIMESTAMP      | Date de mise à jour (rarement utilisée).          |

#### **Relations**
- `book_id` est une clé étrangère pointant vers `books.id`.

#### **Contraintes et Suggestions**
- **Clé unique** : Ajoutez une contrainte unique sur `book_id` + `session_id` pour empêcher qu’un utilisateur ne like/dislike plusieurs fois le même livre.
- **Index** : Utilisez un index sur `book_id` pour améliorer les performances des requêtes liées aux livres.

---

### **Relations entre les tables**
1. **`books` → `likes`** (relation 1:N) :
   - Un livre peut avoir plusieurs likes et dislikes.
   - La suppression d’un livre entraîne la suppression automatique de ses likes et dislikes associés (cascade delete).

---

### **Diagramme relationnel simplifié**
```
+----------------+        +----------------+
|    books       |        |     likes      |
+----------------+        +----------------+
| id  (PK)       |<---+   | id  (PK)       |
| title          |    |   | book_id (FK)   |
| description    |    +---| session_id     |
| author         |        | type           |
| likes_count    |        | created_at     |
| dislikes_count |        | updated_at     |
| created_at     |        +----------------+
| updated_at     |
+----------------+
```

---

### **Optimisation des performances**
- **Caching des likes/dislikes** : Les champs `likes_count` et `dislikes_count` dans la table `books` permettent de réduire les calculs lors de l’affichage des données.
- **Indexation** : Assurez-vous que les colonnes `book_id` et `session_id` dans `likes` sont bien indexées pour améliorer les performances des requêtes.
- **Cascade Delete** : Configurez une suppression en cascade pour simplifier la gestion des relations.

---


## **API Routes**

### **Livres**
Les routes ci-dessous permettent de gérer les livres au sein de l'application. Toutes les données sont échangées au format JSON.

---

#### **1. Récupérer tous les livres**
- **Endpoint**: `GET /api/books`
- **Description**: Récupère la liste de tous les livres disponibles.
- **Paramètres**: Aucun
- **Réponse (200)**:
  ```json
  [
    {
      "id": 1,
      "title": "Titre du livre",
      "author": "Nom de l'auteur",
      "description": "Description du livre",
      "pdf_url": "https://exemple.com/fichier.pdf",
      "likes": 123,
      "category": "Fiction"
    }
  ]
  ```

---

#### **2. Créer un nouveau livre**
- **Endpoint**: `POST /api/books`
- **Description**: Ajoute un nouveau livre à la base de données.
- **Paramètres (body)**:
  ```json
  {
    "title": "Titre du livre",
    "author": "Nom de l'auteur",
    "description": "Description du livre",
    "category_id": 2,
    "pdf_file": "Fichier PDF (upload multipart/form-data)"
  }
  ```
- **Réponse (201)**:
  ```json
  {
    "message": "Livre créé avec succès",
    "book": {
      "id": 1,
      "title": "Titre du livre",
      "author": "Nom de l'auteur",
      "description": "Description du livre",
      "pdf_url": "https://exemple.com/fichier.pdf",
      "category_id": 2
    }
  }
  ```
- **Codes d'erreur**:
  - `400` : Paramètres invalides ou fichier manquant.

---

#### **3. Récupérer un livre spécifique**
- **Endpoint**: `GET /api/books/{id}`
- **Description**: Récupère les détails d’un livre spécifique en fonction de son ID.
- **Paramètres**:
  - `id` : L'identifiant unique du livre (dans l'URL).
- **Réponse (200)**:
  ```json
  {
    "id": 1,
    "title": "Titre du livre",
    "author": "Nom de l'auteur",
    "description": "Description du livre",
    "pdf_url": "https://exemple.com/fichier.pdf",
    "likes": 123,
    "category": "Fiction",
    "comments": [
      {
        "id": 1,
        "content": "Commentaire sur le livre",
        "created_at": "2024-12-06T10:00:00Z"
      }
    ]
  }
  ```
- **Codes d'erreur**:
  - `404` : Livre non trouvé.

---

#### **4. Mettre à jour un livre**
- **Endpoint**: `PUT /api/books/{id}`
- **Description**: Met à jour les informations d’un livre existant.
- **Paramètres (body)**:
  ```json
  {
    "title": "Nouveau titre",
    "author": "Nouvel auteur",
    "description": "Nouvelle description",
    "category_id": 3
  }
  ```
- **Réponse (200)**:
  ```json
  {
    "message": "Livre mis à jour avec succès",
    "book": {
      "id": 1,
      "title": "Nouveau titre",
      "author": "Nouvel auteur",
      "description": "Nouvelle description",
      "pdf_url": "https://exemple.com/fichier.pdf",
      "category_id": 3
    }
  }
  ```
- **Codes d'erreur**:
  - `400` : Paramètres invalides.
  - `404` : Livre non trouvé.

---

#### **5. Supprimer un livre**
- **Endpoint**: `DELETE /api/books/{id}`
- **Description**: Supprime un livre en fonction de son ID.
- **Paramètres**:
  - `id` : L'identifiant unique du livre (dans l'URL).
- **Réponse (200)**:
  ```json
  {
    "message": "Livre supprimé avec succès"
  }
  ```
- **Codes d'erreur**:
  - `404` : Livre non trouvé.

---

Cette version de la documentation offre une structure claire, détaille les attentes et résultats, et permet aux développeurs de comprendre rapidement comment utiliser chaque route de l'API.
### Likes

POST /api/books/{id}/toggle - Toggle like/dislike sur un livre


## Utilisation

### Gestion des Livres

1. **Créer un livre**
   - Accédez à la page de création
   - Remplissez le formulaire avec les informations du livre
   - Cliquez sur "Créer"

2. **Modifier un livre**
   - Cliquez sur le bouton d'édition d'un livre
   - Modifiez les informations souhaitées
   - Sauvegardez les modifications

3. **Système de Likes**
   - Cliquez sur le pouce vers le haut pour liker
   - Cliquez sur le pouce vers le bas pour disliker
   - Cliquez à nouveau pour annuler votre vote

## Sécurité

- Protection CSRF sur tous les formulaires
- Validation des données entrantes
- Session unique pour chaque utilisateur
- Sanitization des entrées utilisateur

## Contribution

1. Fork le projet
2. Créez votre branche (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## License

Ce projet est sous licence MIT - voir le fichier [LICENSE.md](LICENSE.md) pour plus de détails.
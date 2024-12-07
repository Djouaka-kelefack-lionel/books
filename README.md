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

## Installation

1. Clonez le repository :

bash
git clone [URL_DU_REPO]
cd books


2. Installez les dépendances PHP :

bash
composer install


3. Installez les dépendances JavaScript :

bash
npm install
npm run dev


4. Créez une copie du fichier .env :

bash
cp .env.example .env


5. Générez la clé d'application :

bash
php artisan key:generate


## Configuration

1. Configurez votre base de données dans le fichier `.env` :

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=books
DB_USERNAME=votre_username
DB_PASSWORD=votre_password


2. Lancez les migrations :

bash
php artisan migrate


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


## Administration

### Accès à l'Administration
- URL : `/admin`
- Connexion requise avec des identifiants administrateur

### Création d'un Compte Admin



php artisan make:admin    # Crée un nouvel administrateur



### Fonctionnalités Administratives

#### Gestion des Utilisateurs
- Création/Modification/Suppression des comptes administrateurs
- Gestion des permissions
- Visualisation des logs de connexion

#### Gestion des Livres
- Vue d'ensemble de tous les livres
- Validation des nouveaux livres
- Modification/Suppression en masse
- Gestion des catégories de livres
- Statistiques de likes/dislikes

#### Tableau de Bord
- Statistiques globales
  - Nombre total de livres
  - Activité des likes/dislikes
  - Livres les plus populaires
- Graphiques d'activité
- Rapports exportables

#### Modération
- Surveillance des activités suspectes
- Blocage de sessions
- Historique des actions de modération

### Rôles et Permissions
- Super Admin : Accès complet
- Modérateur : Gestion des livres et modération
- Éditeur : Gestion du contenu uniquement

### Sécurité Administrative
- Authentification à deux facteurs
- Journal des actions administratives
- Restrictions IP (optionnel)
- Sessions sécurisées


## Structure de la Base de Données

### Table `books`
- id (primary key)
- title
- description
- author
- likes_count
- dislikes_count
- created_at
- updated_at

### Table `likes`
- id (primary key)
- book_id (foreign key)
- session_id
- type (like/dislike)
- created_at
- updated_at



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
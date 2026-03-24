# Tool4Staffing — Test technique

Application web permettant de servir du contenu personnalisé à plusieurs clients à partir d'une base de code unique, dans un contexte SaaS inspiré des problématiques HRTech.

---

## Sommaire

- [Installation](#installation)
- [Architecture](#architecture)
- [Fonctionnement global](#fonctionnement-global)
- [Étapes de développement](#étapes-de-développement)
- [Choix techniques](#choix-techniques)
- [Sécurité](#sécurité)
- [Tests unitaires](#tests-unitaires)
- [Notes](#notes)
- [Axes d'amélioration](#axes-damélioration)

---

## Installation
```bash
# Cloner le projet
git clone 

# Installer les dépendances
composer install

# Lancer un serveur PHP local
php -S localhost:8000
```

Ouvrir `http://localhost:8000`

---

## Architecture
```
tool4staffing-test-technique/
├── public/                    # Point d'entrée web
│   ├── index.php            # Front controller + routing
│   └── assets/              # CSS/JS
│       ├── css/style.css
│       └── js/app.js
├── src/                     # Code source applicatif
│   ├── Controller/          # Contrôleurs
│   │   ├── CarController.php
│   │   └── GarageController.php
│   ├── Core/               # Cœur applicatif
│   │   └── Router.php
│   ├── Model/              # Modèles de données
│   │   ├── Car.php
│   │   └── Garage.php
│   ├── Repository/         # Accès aux données
│   │   ├── CarRepository.php
│   │   └── GarageRepository.php
│   ├── Service/            # Logique métier
│   │   ├── CarService.php
│   │   └── GarageService.php
│   └── Security/           # Sécurité
│       └── ClientContext.php
├── views/                   # Templates
│   ├── cars/
│   │   ├── list.php
│   │   └── detail.php
│   └── garages/
│       ├── list.php
│       └── detail.php
├── data/                   # Données JSON
│   ├── cars.json
│   └── garages.json
├── config.php              # Configuration
├── composer.json
└── README.md
```

---

## Fonctionnement global

L'application utilise une architecture MVC moderne avec routing côté serveur :

1. **Front Controller** : [public/index.php](cci:7://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/public/index.php:0:0-0:0) gère toutes les requêtes HTTP
2. **Routing** : Le [Router](cci:2://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Core/Router.php:3:0-42:1) analyse l'URL et dispatche vers les contrôleurs appropriés
3. **Client Context** : Un cookie `client` identifie le client actif (`clienta`, `clientb`, `clientc`)
4. **Services** : Logique métier avec filtrage automatique par client
5. **Repositories** : Accès aux données JSON via le pattern Repository
6. **Views** : Templates PHP qui génèrent le HTML affiché dans la `.dynamic-div`

---

## Étapes de développement

### Étape 1 — Architecture MVC et Routing
 
- **Front Controller** : [public/index.php](cci:7://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/public/index.php:0:0-0:0) comme point d'entrée unique avec routing
- **Client Context** : Un cookie `client` identifie le client actif (`clienta`, `clientb`, `clientc`)
- **Services** : Logique métier avec filtrage automatique par client
- **Repositories** : Pattern Repository pour accès aux données JSON
- **Views** : Templates PHP qui génèrent le HTML injecté dans la `.dynamic-div`
- **Navigation AJAX** : jQuery gère les changements de client/module sans rechargement de page
 
### Étape 2 — Vue liste des voitures

- **Architecture MVC** : [CarController](cci:2://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Controller/CarController.php:8:0-39:1) orchestre [CarService](cci:2://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Service/CarService.php:8:0-80:1) et [CarRepository](cci:2://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Repository/CarRepository.php:6:0-35:1)
- **Chargement des données** : [CarRepository](cci:2://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Repository/CarRepository.php:6:0-35:1) lit [data/cars.json](cci:7://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/data/cars.json:0:0-0:0) et crée les objets [Car](cci:2://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Model/Car.php:4:0-55:1)
- **Filtrage par client** : [CarService](cci:2://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Service/CarService.php:8:0-80:1) filtre automatiquement selon le cookie client
- **Configuration client** : [config.php](cci:7://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/config.php:0:0-0:0) définit les champs à afficher par client
- **Affichage personnalisé** :
  - **Client A** : Nom, Marque, Année, Puissance (+ colorisation par âge)
  - **Client B** : Nom (minuscule), Marque, Garage
  - **Client C** : Nom, Marque, Couleur (pastille + code hex)

### Étape 3 — Vue détail d'une voiture

- **Architecture MVC** : [CarController::show()](cci:1://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Controller/CarController.php:26:4-38:5) gère l'affichage détaillé
- **Récupération par ID** : [CarService::getCarById()](cci:1://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Service/CarService.php:55:4-79:5) trouve la voiture et vérifie l'appartenance au client
- **Génération de la vue** : Template [views/cars/detail.php](cci:7://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/views/cars/detail.php:0:0-0:0) affiche toutes les informations
- **Navigation AJAX** : Clic sur une voiture → chargement du détail dans la `.dynamic-div`
- **Bouton retour** : Permet de revenir à la liste sans rechargement de page
- **Affichage personnalisé** : Champs affichés selon la configuration du client

### Étape 4 — Module Garage (Client B uniquement)

- **Architecture MVC** : [GarageController](cci:2://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Controller/GarageController.php:7:0-38:1) et [GarageService](cci:2://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/src/Service/GarageService.php:7:0-46:1) sur le même pattern que les voitures
- **Contrôle d'accès** : Le module garage n'est visible que pour Client B via [updateModuleNav()](cci:1://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/public/assets/js/app.js:23:0-29:1)
- **Fonctionnalités complètes** : Liste des garages et vue détaillée de chaque garage
- **Navigation AJAX** : Switcher entre modules Voitures/Garages sans rechargement
- **Isolation des données** : Seuls les garages du Client B sont affichés
- **Templates dédiés** : [views/garages/list.php](cci:7://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/views/garages/list.php:0:0-0:0) et [views/garages/detail.php](cci:7://file:///Users/thyssem/Desktop/Bureau%20-%20MacBook%20Pro%20%2810%29/formation/projetPerso/Test-technique/tool4staffing-test-technique/views/garages/detail.php:0:0-0:0)

### Étape 5 — Colorisation Client A

La logique de colorisation des voitures pour le Client A est désormais gérée côté modèle via la méthode `Car::getAgeClass()` :  

- Rouge : voitures de plus de 10 ans  
- Vert : voitures de moins de 2 ans  
- Autre : aucune classe spécifique

Chaque voiture renvoie sa classe CSS directement, ce qui permet à la vue liste (`ajax.php`) d’appliquer la couleur automatiquement sur la ligne `<tr>` correspondante, sans logique additionnelle dans les vues.

Cette fonctionnalité est entièrement encapsulée dans le modèle `Car`, et utilisée via `CarService::getCarsForClient()` pour préparer les données avec les `visibleFields` corrects avant affichage.  

> Les données actuelles de `data/cars.json` (2021-2023) ne couvrent pas toutes les plages, mais la logique a été testée et validée avec des données temporaires simulant des voitures anciennes et très récentes.

### Étape 6 — Sécurisation

#### Faille 1 — Path Traversal

**Problème** : le cookie `client` est lu directement par jQuery pour construire l'URL,
sans validation côté serveur avant l'appel. Un attaquant peut forger le cookie avec
`../../credentials` pour accéder à des fichiers sensibles.

**Solution** : mettre en place un point d'entrée PHP unique qui valide le client via
la whitelist **avant** de router vers le bon fichier, plutôt que de laisser jQuery
construire librement les chemins.

---

#### Faille 2 — Accès direct aux fichiers PHP

**Problème** : les fichiers `ajax.php` et `edit.php` (dans `customs/[client]/modules/...`) étaient accessibles directement par URL sans aucune vérification. N'importe qui pouvait charger les données d’un client, contournant le `ClientContext` et les `Services`.

**Solution** :  
- Tous les fichiers `ajax.php` / `edit.php` **ne sont plus responsables de la logique métier**. Ils ne font qu'afficher les données passées par les Services (`CarService`, `GarageService`).  
- Chaque Service filtre les données par client grâce à `ClientContext`.  
- Le point d'entrée PHP (`index.php`) **valide systématiquement le client** avant de charger les modules et les scripts correspondants.  
- Accès direct aux fichiers PHP côté client est désormais inutile et sans impact, car aucun fichier ne peut retourner des données sensibles sans passer par `ClientContext` et les Services.  

---

#### Faille 3 — XSS (Cross-Site Scripting)

**Problème potentiel** : si une valeur malveillante était injectée dans le cookie ou dans les fichiers JSON (`cars.json`, `garages.json`) et affichée sans échappement, elle pourrait exécuter du JS arbitraire.

**Déjà protégé** :  
- La lecture du client passe par `ClientContext` qui valide le client connecté via une whitelist.  
- Les Services (`CarService`, `GarageService`) exposent uniquement les données filtrées pour le client actif.  
- Toutes les données affichées dans les vues (`ajax.php`, `edit.php`) passent par `htmlspecialchars()` pour empêcher l’exécution de code malveillant.  
- Les Models et Services contrôlent et filtrent les propriétés visibles (`visibleFields`) selon les besoins du client.

---

#### Faille 4 — Exposition de la clé API

**Problème** : le fichier `credentials/credentials.json` est accessible directement
par URL, exposant la clé API publiquement.

**Solutions** :
- Utiliser un fichier `.env` non commité pour stocker les secrets (déjà fait)
- Ajouter `credentials/` au `.gitignore` (déjà fait)
- En production sur Apache, bloquer l'accès via `.htaccess` :
```apache
Deny from all
```

- En production sur Nginx :
```nginx
location /credentials {
    deny all;
}
```

---

#### Faille 5 — Absence d'authentification réelle

**Problème** : le cookie `client` peut être forgé manuellement par n'importe qui pour accéder aux données d'un autre client sans aucune vérification d'identité.  
Même si les Services filtrent les données par client (`CarService`, `GarageService`), un cookie manipulé peut toujours permettre d’essayer de charger des fichiers d’un autre client via les vues (`ajax.php`, `edit.php`).

**Solution** : mettre en place une authentification côté serveur :
- Sessions PHP avec login/mot de passe par client
- Stocker l'identité du client en session serveur et la passer aux Services (`ClientContext`) pour filtrer les données
- Ne jamais faire confiance uniquement à un cookie côté client pour identifier un utilisateur
- Vérifier côté Service que les entités (Car / Garage) appartiennent bien au client actif avant de les retourner

## Choix techniques

### Séparation des responsabilités

- `App\Repository\*` : accès aux données (`CarRepository`, `GarageRepository`)  
- `App\Service\*` : logique métier et filtrage par client (`CarService`, `GarageService`)  
- `App\Model\*` : représentation des entités (`Car`, `Garage`)  
- `config.php` : configuration globale (whitelist des clients et paramètres spécifiques)  
- Les vues (`ajax.php`, `edit.php`) ne contiennent que de l'affichage et utilisent les Services pour récupérer les données filtrées par client
- `ClientContext` : centralise l'identité du client connecté pour tous les Services

### Namespaces

Chaque fichier est organisé sous un namespace explicite (`App\Repository`, `App\Service`, `App\Model`), ce qui évite les collisions de noms et rend les dépendances claires via les directives `use`.

### Gestion des erreurs

- Les exceptions sont lancées dans les Services et les Repositories pour gérer : données manquantes, JSON invalide ou fichiers introuvables
- Chaque vue wrappe ses appels aux Services dans un `try/catch` pour afficher un message d'erreur générique
- Le logging peut se faire via `error_log` ou un système de journalisation centralisé pour la production

---

## Tests unitaires
```bash
./vendor/bin/phpunit
```

Les tests couvrent :

- `CarTest` : logique de colorisation `getCarAgeClass` — cas > 10 ans, < 2 ans, entre les deux, limites exactes
- `CookieTest` : whitelist `getClient` — client valide, client invalide, cookie absent
- `DataTest` : chargement JSON — fichier valide, fichier inexistant, JSON invalide

---

## Notes

> Le fichier `credentials/credentials.json` contient une clé API.
> Il ne doit pas être commité en production, protégé via `.gitignore`.

---

## Axes d'amélioration

- **Router PHP central** : un point d'entrée unique qui valide le client avant de router, plutôt que de laisser jQuery construire les chemins librement
- **Authentification** : sessions PHP avec login/mot de passe par client
- **`display_errors = Off`** : à configurer en production dans `php.ini`
- **Logging avancé** : remplacer `error_log` par Monolog pour une journalisation centralisée et configurable
- **Migration Symfony** : l'architecture actuelle (namespaces, séparation des responsabilités, injection de dépendances) est pensée pour faciliter une migration vers Symfony

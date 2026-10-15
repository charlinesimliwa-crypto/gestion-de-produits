# Gestion de produits et espace client

Application web développée en **PHP (PDO)** et **MySQL** dans le cadre d'un stage. Elle comporte deux espaces :

- un **espace administrateur** pour gérer les produits et suivre les commandes ;
- un **espace client** où l'on parcourt les produits par catégorie, remplit un panier et valide une commande, sans créer de compte.

## Fonctionnalités

### Espace administrateur
- Liste, ajout, modification et suppression des produits (CRUD complet)
- Rattachement de chaque produit à une catégorie
- Liste des commandes avec le nom du client, la date, le statut et le total
- Détail d'une commande (produits, quantités, prix unitaires)
- Suppression d'une commande

### Espace client
- Choix d'une catégorie parmi des « bulles » cliquables
- Liste des produits de la catégorie choisie
- Panier stocké en session PHP, avec cumul des quantités
- Validation de la commande avec le nom et le numéro de téléphone du client
- Création automatique du client, ou réutilisation s'il existe déjà (recherche par téléphone)
- Page de confirmation avec possibilité d'annuler la commande

## Technologies

| Élément | Choix |
|---|---|
| Langage | PHP 8 (orienté objet) |
| Base de données | MySQL |
| Accès aux données | PDO, requêtes préparées |
| Interface | HTML5 et CSS3 |
| Environnement local | WampServer |

## Structure du projet

```
gestion-produits/
├── config/
│   └── database.example.php   Modèle de configuration de la base
├── includes/
│   ├── header.php             En-tête et navigation communs
│   └── footer.php             Pied de page commun
├── models/
│   ├── produit.php            Requêtes sur les produits
│   ├── categorie.php          Requêtes sur les catégories
│   ├── client.php             Requêtes sur les clients
│   ├── facture.php            Requêtes sur les commandes
│   └── ligne_facture.php      Détail des commandes
├── public/
│   ├── index.php, ajouter.php, modifier.php, supprimer.php
│   ├── factures.php, facture.php, supprimer_facture.php
│   ├── commande.php, categorie.php, panier.php
│   ├── ajouter_panier.php, valider_commande.php
│   ├── confirmation.php, annuler_commande.php
│   └── assets/css/style.css
└── sql/
    └── gestion_produits.sql   Structure de la base et catégories
```

Les dossiers suivent une séparation simple : `models/` contient l'accès aux données, `public/` contient les pages affichées, et `includes/` évite de répéter le HTML commun.

## Base de données

Six tables : `categories`, `produits`, `clients`, `factures`, `lignes_facture` et `personnels`.

```
categories (1) ----< produits (N)
clients    (1) ----< factures (N) ----< lignes_facture (N) >---- produits (1)
```

## Installation avec WampServer

1. **Cloner ou télécharger** le dépôt, puis placer le dossier dans `C:\wamp64\www\`.
2. **Créer la base** : ouvrir `http://localhost/phpmyadmin`, cliquer sur « Nouvelle base de données », la nommer `gestion_de_produits` (interclassement `utf8mb4_general_ci`).
3. **Importer les tables** : sélectionner cette base, onglet « Importer », choisir `sql/gestion_produits.sql`. Les 10 catégories sont ajoutées automatiquement.
4. **Configurer la connexion** : copier `config/database.example.php` en `config/database.php`, puis vérifier `DB_NAME`, `DB_USER` et `DB_PASS`.
5. **Lancer WampServer** et ouvrir les pages.

## Pages principales

Remplacer `<dossier>` par le chemin du projet dans `www`.

| Espace | Page | Adresse |
|---|---|---|
| Admin | Produits | `http://localhost/<dossier>/public/index.php` |
| Admin | Commandes | `http://localhost/<dossier>/public/factures.php` |
| Client | Catégories | `http://localhost/<dossier>/public/commande.php` |
| Client | Panier | `http://localhost/<dossier>/public/panier.php` |

## Sécurité

- Requêtes préparées PDO pour toutes les interactions avec la base (protection contre les injections SQL)
- `htmlspecialchars()` sur les données affichées (protection contre les failles XSS)
- Redirection après chaque formulaire (Post/Redirect/Get) pour éviter les envois en double
- Le fichier `config/database.php` est exclu du dépôt via `.gitignore`

## Limites actuelles et pistes d'amélioration

- Pas encore d'authentification : l'espace administrateur est accessible à tous (la table `personnels` est prévue pour cela)
- Le stock n'est pas décrémenté automatiquement à la validation d'une commande
- Le statut des commandes (`en_attente`) n'est pas encore modifiable depuis l'interface
- Avant une mise en ligne, désactiver l'affichage des erreurs PHP et utiliser un compte MySQL protégé par un mot de passe

## Auteur

Charline, projet réalisé lors d'un stage de première année.

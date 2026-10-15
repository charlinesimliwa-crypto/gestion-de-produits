<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des produits</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">
            <?= isset($client) && $client ? 'Plateforme de commande' : 'Gestion Produits' ?>
        </a>
        <?php if (!isset($client) || !$client): ?>
        <div class="nav-links">
            <a href="index.php">Produits</a>
            <a href="ajouter.php">+ Ajouter</a>
            <a href="factures.php">Commandes</a>
        </div>
        <?php else: ?>
        <div class="nav-links">
            <a href="commande.php">Catégories</a>
            <a href="panier.php">Mon panier</a>
        </div>
        <?php endif; ?>
    </nav>

    <main class="container">

<?php
session_start();

if (isset($_POST['produit_id'], $_POST['quantite'])) {
    $Idproduits = (int) $_POST['produit_id'];
    $quantite   = (int) $_POST['quantite'];

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    if (isset($_SESSION['panier'][$Idproduits])) {
        $_SESSION['panier'][$Idproduits] += $quantite;
    } else {
        $_SESSION['panier'][$Idproduits] = $quantite;
    }

    header("Location: panier.php");
    exit();
} else {
    header("Location: categorie.php");
    exit();
}

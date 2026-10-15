<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/client.php';
require_once __DIR__ . '/../models/produit.php';
require_once __DIR__ . '/../models/facture.php';
require_once __DIR__ . '/../models/ligne_facture.php';

$panier = $_SESSION['panier'] ?? [];
if (empty($panier)) {
    header("Location: panier.php");
    exit();
}

$nom = $_POST['nom_client'] ?? '';
$telephone = $_POST['telephone_client'] ?? '';

if ($nom === '' || $telephone === '') {
    die("Merci de renseigner votre nom et votre numéro.");
}

$clientModel = new Client($pdo);
$produitModel = new Produit($pdo);
$factureModel = new Facture($pdo);
$ligneFactureModel = new LigneFacture($pdo);

$clientId = $clientModel->trouverOuCreer($nom, $telephone);

$factureId = $factureModel->creer($clientId);

foreach ($panier as $produitId => $quantite) {
    $produit = $produitModel->getById($produitId);
    if (!$produit) {
        continue;
    }
    $ligneFactureModel->add($factureId, $produitId, $quantite, $produit['Prix']);
}

$total = $ligneFactureModel->calculerTotal($factureId);
$factureModel->updateTotal($factureId, $total);

unset($_SESSION['panier']);
$_SESSION['derniere_facture_id'] = $factureId;

header("Location: confirmation.php");
exit();

<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/facture.php';
require_once __DIR__ . '/../models/ligne_facture.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $ligneFactureModel = new LigneFacture($pdo);
    $factureModel = new Facture($pdo);

    $ligneFactureModel->deleteByFactureId($id);
    $factureModel->delete($id);
}

unset($_SESSION['derniere_facture_id']);

header("Location: commande.php");
exit();

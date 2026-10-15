<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/produit.php';

$produitModel = new Produit($pdo);

$id = $_GET['id'] ?? null;
if ($id) {
    $produitModel->delete($id);
}

header("Location: index.php");
exit();

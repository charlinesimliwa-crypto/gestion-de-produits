<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/facture.php';
require_once __DIR__ . '/../models/ligne_facture.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Aucune commande sélectionnée.");
}

$factureModel = new Facture($pdo);
$ligneFactureModel = new LigneFacture($pdo);

$facture = $factureModel->getById($id);
if (!$facture) {
    die("Commande introuvable.");
}

$lignes = $ligneFactureModel->getByFactureId($id);

require __DIR__ . '/../includes/header.php';
?>

<h1>Commande #<?= $facture['Idfactures'] ?></h1>

<p><strong>Client :</strong> <?= htmlspecialchars($facture['nom_client']) ?></p>
<p><strong>Téléphone :</strong> <?= htmlspecialchars($facture['Telephone']) ?></p>
<p><strong>Date :</strong> <?= $facture['Date_facture'] ?></p>
<p><strong>Statut :</strong> <?= htmlspecialchars($facture['Statut']) ?></p>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Sous-total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lignes as $ligne): ?>
            <tr>
                <td><?= htmlspecialchars($ligne['nom_produit']) ?></td>
                <td><?= $ligne['quantite'] ?></td>
                <td><?= number_format($ligne['prix_unitaire'], 2) ?> F CFA</td>
                <td><?= number_format($ligne['quantite'] * $ligne['prix_unitaire'], 2) ?> F CFA</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Total : <?= number_format($facture['Total'], 2) ?> F CFA</h2>

<a href="factures.php">← Retour à la liste des commandes</a>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/produit.php';

$produitModel = new Produit($pdo);
$produits = $produitModel->getAll();

require __DIR__ . '/../includes/header.php';
?>

<h1>Liste des produits</h1>

<a href="ajouter.php">+ Ajouter un produit</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($produits)): ?>
            <tr>
                <td colspan="6">Aucun produit pour le moment.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= $produit['Idproduits'] ?></td>
                    <td><?= htmlspecialchars($produit['Nom']) ?></td>
                    <td><?= htmlspecialchars($produit['Description']) ?></td>
                    <td><?= number_format($produit['Prix'], 2) ?> F CFA</td>
                    <td><?= $produit['Quantite_stock'] ?></td>
                    <td>
                        <a href="modifier.php?id=<?= $produit['Idproduits'] ?>">Modifier</a>
                        |
                        <a href="supprimer.php?id=<?= $produit['Idproduits'] ?>" onclick="return confirm('Supprimer ce produit ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../includes/footer.php'; ?>

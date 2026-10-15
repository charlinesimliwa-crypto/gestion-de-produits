<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/produit.php';
require_once __DIR__ . '/../models/categorie.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Aucune catégorie sélectionnée.");
}

$produitModel = new Produit($pdo);
$categorieModel = new Categorie($pdo);

$categorie = $categorieModel->getById($id);
if (!$categorie) {
    die("Catégorie introuvable.");
}

$produits = $produitModel->getByCategorie($id);

$client = true;

require __DIR__ . '/../includes/header.php';
?>

<h1>Produits — <?= htmlspecialchars($categorie['Nom']) ?></h1>

<?php if (empty($produits)): ?>
    <p>Aucun produit dans cette catégorie pour le moment.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['Nom']) ?></td>
                    <td><?= htmlspecialchars($produit['Description']) ?></td>
                    <td><?= number_format($produit['Prix'], 2) ?> F CFA</td>
                    <td><?= $produit['Quantite_stock'] ?></td>
                    <td>
                        <form method="POST" action="ajouter_panier.php">
                            <input type="hidden" name="produit_id" value="<?= $produit['Idproduits'] ?>">
                            <input type="number" name="quantite" value="1" min="1" style="width: 60px;">
                            <button type="submit">Ajouter au panier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="commande.php">← Retour aux catégories</a>

<?php require __DIR__ . '/../includes/footer.php'; ?>

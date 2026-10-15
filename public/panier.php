<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/produit.php';

$produitModel = new Produit($pdo);

$panier = $_SESSION['panier'] ?? [];
$total = 0;

$client = true;

require __DIR__ . '/../includes/header.php';
?>

<h1>Votre panier</h1>

<?php if (empty($panier)): ?>
    <p>Votre panier est vide.</p>
    <a href="commande.php">← Voir les catégories</a>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($panier as $produitId => $quantite): ?>
                <?php
                $produit = $produitModel->getById($produitId);
                if (!$produit) {
                    continue;
                }
                $sousTotal = $quantite * $produit['Prix'];
                $total += $sousTotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($produit['Nom']) ?></td>
                    <td><?= number_format($produit['Prix'], 2) ?> F CFA</td>
                    <td><?= $quantite ?></td>
                    <td><?= number_format($sousTotal, 2) ?> F CFA</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Total : <?= number_format($total, 2) ?> F CFA</h2>

    <form method="POST" action="valider_commande.php">
        <label>Votre nom :</label>
        <input type="text" name="nom_client" required>

        <label>Votre numéro de téléphone :</label>
        <input type="text" name="telephone_client" required>

        <button type="submit">Valider la commande</button>
    </form>

    <a href="commande.php">← Continuer mes achats</a>
<?php endif; ?>

<?php require __DIR__ . '/../includes/footer.php'; ?>

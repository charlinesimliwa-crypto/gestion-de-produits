<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/facture.php';

$factureModel = new Facture($pdo);
$factures = $factureModel->getAll();

require __DIR__ . '/../includes/header.php';
?>

<h1>Liste des commandes</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($factures)): ?>
            <tr><td colspan="6">Aucune commande pour le moment.</td></tr>
        <?php else: ?>
            <?php foreach ($factures as $facture): ?>
                <tr>
                    <td><?= $facture['Idfactures'] ?></td>
                    <td><?= htmlspecialchars($facture['nom_client']) ?></td>
                    <td><?= $facture['Date_facture'] ?></td>
                    <td><?= htmlspecialchars($facture['Statut']) ?></td>
                    <td><?= number_format($facture['Total'], 2) ?> F CFA</td>
                    <td>
                        <a href="facture.php?id=<?= $facture['Idfactures'] ?>">Voir détails</a>
                        |
                        <a href="supprimer_facture.php?id=<?= $facture['Idfactures'] ?>" onclick="return confirm('Supprimer cette commande ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../includes/footer.php'; ?>

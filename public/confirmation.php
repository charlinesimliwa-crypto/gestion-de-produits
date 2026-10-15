<?php
session_start();
$factureId = $_SESSION['derniere_facture_id'] ?? null;

$client = true;

require __DIR__ . '/../includes/header.php';
?>

<h1>Commande confirmée !</h1>
<p>Merci pour votre commande. Elle a bien été enregistrée et sera traitée sous peu.</p>

<?php if ($factureId): ?>
    <p>
        <a href="annuler_commande.php?id=<?= $factureId ?>" onclick="return confirm('Voulez-vous vraiment annuler cette commande ?');">
            Annuler cette commande
        </a>
    </p>
<?php endif; ?>

<a href="commande.php">← Retour à la boutique</a>

<?php require __DIR__ . '/../includes/footer.php'; ?>

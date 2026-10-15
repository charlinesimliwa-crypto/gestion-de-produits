<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/produit.php';
require_once __DIR__ . '/../models/categorie.php';

$produitModel = new Produit($pdo);
$categorieModel = new Categorie($pdo);
$categories = $categorieModel->getAll();
$erreur = '';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Aucun produit sélectionné.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'] ?? '';
    $description = $_POST['description'] ?? '';
    $prix = $_POST['prix'] ?? '';
    $quantite = $_POST['quantite_stock'] ?? '';
    $categorieId = $_POST['categorie_id'] ?? null;

    if ($nom === '' || $prix === '' || $quantite === '') {
        $erreur = "Merci de remplir tous les champs obligatoires.";
    } else {
        $produitModel->update($id, $nom, $description, $prix, $quantite, $categorieId);
        header("Location: index.php");
        exit();
    }
} else {
    $produit = $produitModel->getById($id);
    if (!$produit) {
        die("Produit introuvable.");
    }
}

require __DIR__ . '/../includes/header.php';
?>

<h1>Modifier le produit</h1>

<?php if ($erreur): ?>
    <p class="error"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

<form method="POST" action="modifier.php?id=<?= $id ?>">

    <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($produit['Nom']) ?>" required>

    <label>Description :</label>
    <textarea name="description"><?= htmlspecialchars($produit['Description']) ?></textarea>

    <label>Prix :</label>
    <input type="number" step="0.01" name="prix" value="<?= $produit['Prix'] ?>" required>

    <label>Quantité en stock :</label>
    <input type="number" name="quantite_stock" value="<?= $produit['Quantite_stock'] ?>" required>

    <label>Catégorie :</label>
    <select name="categorie_id">
        <option value="">-- Aucune --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['Idcategories'] ?>" <?= ($cat['Idcategories'] == $produit['Idcategories']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['Nom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Enregistrer les modifications</button>

</form>

<a href="index.php">← Retour à la liste</a>

<?php require __DIR__ . '/../includes/footer.php'; ?>

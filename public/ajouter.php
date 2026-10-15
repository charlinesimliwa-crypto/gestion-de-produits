<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/produit.php';
require_once __DIR__ . '/../models/categorie.php';

$produitModel = new Produit($pdo);
$categorieModel = new Categorie($pdo);
$categories = $categorieModel->getAll();
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'] ?? '';
    $description = $_POST['description'] ?? '';
    $prix = $_POST['prix'] ?? '';
    $quantite = $_POST['quantite_stock'] ?? '';
    $categorieId = $_POST['categorie_id'] ?? null;

    if ($nom === '' || $prix === '' || $quantite === '') {
        $erreur = "Merci de remplir tous les champs obligatoires.";
    } else {
        $produitModel->add($nom, $description, $prix, $quantite, $categorieId);
        header("Location: index.php");
        exit();
    }
}

require __DIR__ . '/../includes/header.php';
?>

<h1>Ajouter un produit</h1>

<?php if ($erreur): ?>
    <p class="error"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

<form method="POST" action="ajouter.php">

    <label>Nom :</label>
    <input type="text" name="nom" required>

    <label>Description :</label>
    <textarea name="description"></textarea>

    <label>Prix :</label>
    <input type="number" step="0.01" name="prix" required>

    <label>Quantité en stock :</label>
    <input type="number" name="quantite_stock" required>

    <label>Catégorie :</label>
    <select name="categorie_id">
        <option value="">-- Aucune --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['Idcategories'] ?>"><?= htmlspecialchars($cat['Nom']) ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Ajouter</button>

</form>

<?php require __DIR__ . '/../includes/footer.php'; ?>

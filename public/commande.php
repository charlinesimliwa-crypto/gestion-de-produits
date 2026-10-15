<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/categorie.php';

$categorieModel = new Categorie($pdo);
$categories = $categorieModel->getAll();

$client = true;

require __DIR__ . '/../includes/header.php';
?>

<h1>Espace clients</h1>
<p>Choix de catégories</p>

<div class="grille-categories">
    <?php foreach ($categories as $cat): ?>
        <a href="categorie.php?id=<?= $cat['Idcategories'] ?>" class="bulle-categorie"><?= htmlspecialchars($cat['Nom']) ?></a>
    <?php endforeach; ?>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>

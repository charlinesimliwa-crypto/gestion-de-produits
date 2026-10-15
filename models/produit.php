<?php

class Produit {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $sql = "SELECT * FROM produits";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT * FROM produits WHERE Idproduits = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getByCategorie($Idcategories) {
        $sql = "SELECT * FROM produits WHERE Idcategories = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$Idcategories]);
        return $stmt->fetchAll();
    }

    public function add($nom, $description, $prix, $quantite, $categorieId) {
        $sql = "INSERT INTO produits (Nom, Description, Prix, Quantite_stock, Idcategories) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $description, $prix, $quantite, $categorieId ?: null]);
    }

    public function update($id, $nom, $description, $prix, $quantite, $categorieId) {
        $sql = "UPDATE produits 
                SET Nom = ?, Description = ?, Prix = ?, Quantite_stock = ?, Idcategories = ? 
                WHERE Idproduits = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $description, $prix, $quantite, $categorieId ?: null, $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM produits WHERE Idproduits = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

}

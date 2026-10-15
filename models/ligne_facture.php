<?php

class LigneFacture {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByFactureId($factureId) {
        $sql = "SELECT lignes_facture.*, produits.Nom AS nom_produit 
                FROM lignes_facture 
                JOIN produits ON lignes_facture.produit_id = produits.Idproduits 
                WHERE lignes_facture.facture_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$factureId]);
        return $stmt->fetchAll();
    }

    public function add($factureId, $produitId, $quantite, $prixUnitaire) {
        $sql = "INSERT INTO lignes_facture (facture_id, produit_id, quantite, prix_unitaire) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$factureId, $produitId, $quantite, $prixUnitaire]);
    }

    public function calculerTotal($factureId) {
        $sql = "SELECT SUM(quantite * prix_unitaire) AS total 
                FROM lignes_facture 
                WHERE facture_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$factureId]);
        $resultat = $stmt->fetch();
        return $resultat['total'] ?? 0;
    }

    public function deleteByFactureId($factureId) {
        $sql = "DELETE FROM lignes_facture WHERE facture_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$factureId]);
    }

}

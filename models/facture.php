<?php

class Facture {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $sql = "SELECT factures.*, clients.Nom AS nom_client 
                FROM factures 
                JOIN clients ON factures.Idclients = clients.Idclients 
                ORDER BY factures.Date_facture DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT factures.*, clients.Nom AS nom_client, clients.Email, clients.Adresse, clients.Telephone 
                FROM factures 
                JOIN clients ON factures.Idclients = clients.Idclients 
                WHERE factures.Idfactures = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function creer($clientId) {
        $sql = "INSERT INTO factures (Idclients, Statut, Total) VALUES (?, 'en_attente', 0)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$clientId]);
        return $this->pdo->lastInsertId();
    }

    public function updateTotal($id, $total) {
        $sql = "UPDATE factures SET Total = ? WHERE Idfactures = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$total, $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM factures WHERE Idfactures = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

}

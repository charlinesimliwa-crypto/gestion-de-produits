<?php

class Client {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $sql = "SELECT * FROM clients";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT * FROM clients WHERE Idclients = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function add($nom, $adresse, $email, $telephone) {
        $sql = "INSERT INTO clients (Nom, Adresse, Email, Telephone) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $adresse, $email, $telephone]);
    }

    public function trouverOuCreer($nom, $telephone) {
        $sql = "SELECT * FROM clients WHERE Telephone = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$telephone]);
        $client = $stmt->fetch();

        if ($client) {
            return $client['Idclients'];
        }

        $this->add($nom, null, null, $telephone);
        return $this->pdo->lastInsertId();
    }

}

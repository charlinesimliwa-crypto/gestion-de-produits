
CREATE TABLE categories (
    Idcategories INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(100) NOT NULL
);

CREATE TABLE produits (
    Idproduits INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(100) NOT NULL,
    Description TEXT,
    Prix DECIMAL(10,2) NOT NULL,
    Quantite_stock INT NOT NULL DEFAULT 0,
    Idcategories INT,
    FOREIGN KEY (Idcategories) REFERENCES categories(Idcategories)
);

CREATE TABLE clients (
    Idclients INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(100) NOT NULL,
    Adresse VARCHAR(255),
    Email VARCHAR(255),
    Telephone VARCHAR(20),
    Date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE factures (
    Idfactures INT PRIMARY KEY AUTO_INCREMENT,
    Idclients INT NOT NULL,
    Date_facture DATETIME DEFAULT CURRENT_TIMESTAMP,
    Statut VARCHAR(50) NOT NULL DEFAULT 'en_attente',
    Total DECIMAL(10,2) NOT NULL DEFAULT 0,
    FOREIGN KEY (Idclients) REFERENCES clients(Idclients)
);

CREATE TABLE lignes_facture (
    id INT PRIMARY KEY AUTO_INCREMENT,
    facture_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (facture_id) REFERENCES factures(Idfactures),
    FOREIGN KEY (produit_id) REFERENCES produits(Idproduits)
);

CREATE TABLE personnels (
    Idpersonnels INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(100) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Mot_de_passe VARCHAR(255) NOT NULL,
    Role VARCHAR(50) NOT NULL DEFAULT 'vendeur',
    Date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categories (Nom) VALUES
('Alimentation'),
('Boissons'),
('Hygiène et beauté'),
('Électroménager'),
('Vêtements'),
('Papeterie'),
('Nettoyage'),
('Cuisine et vaisselle'),
('Bricolage'),
('Jouets');

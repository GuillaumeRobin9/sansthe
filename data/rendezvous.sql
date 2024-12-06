CREATE DATABASE IF NOT EXISTS sansthe;

USE sansthe;

CREATE TABLE IF NOT EXISTS rendezvous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    antecedents TEXT,
    douleurs INT,
    raison TEXT NOT NULL,
    etat_sante TEXT NOT NULL
);

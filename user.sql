CREATE DATABASE IF NOT EXISTS sansthe;

USE sansthe;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (nom, prenom, username, password) VALUES
('AUGUSTE', 'Alexandre', 'aauguste', 'password'),
('BRANGER', 'Clément', 'cbranger', 'password'),
('FREMOND', 'Marius', 'mfremond', 'password'),
('GRELLIER NEAU', 'Maël', 'mgrellierneau', 'password'),
('HUARD', 'Bastien', 'bhuard', 'password'),
('LAURENT', 'Maxence', 'mlaurent', 'password'),
('LOBEL', 'Martin', 'mlobel', 'password'),
('PEIGNÉ', 'Enzo', 'epeigne', 'password'),
('ROBIN', 'Guillaume', 'grobin', 'password'),
('SABIRON', 'Antonin', 'asabiron', 'password'),
('VENEVONGSOS', 'Noa', 'nvenevongsos', 'password');

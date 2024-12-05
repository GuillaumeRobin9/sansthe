CREATE DATABASE IF NOT EXISTS sansthe;

USE sansthe;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO users (nom, prenom, username) VALUES
('AUGUSTE', 'Alexandre', 'aauguste'),
('BRANGER', 'Clément', 'cbranger'),
('FREMOND', 'Marius', 'mfremond'),
('GRELLIER NEAU', 'Maël', 'mgrellierneau'),
('HUARD', 'Bastien', 'bhuard'),
('LAURENT', 'Maxence', 'mlaurent'),
('LOBEL', 'Martin', 'mlobel'),
('PEIGNÉ', 'Enzo', 'epeigne'),
('ROBIN', 'Guillaume', 'grobin'),
('SABIRON', 'Antonin', 'asabiron'),
('VENEVONGSOS', 'Noa', 'nvenevongsos');

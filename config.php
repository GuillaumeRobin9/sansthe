<?php
// Configuration de la connexion à la base de données
$host = 'localhost'; // Nom d'hôte 
$dbname = 'sansthe'; // Nom de la base de données
$username = 'root';  // Nom d'utilisateur MySQL
$password = 'password';      // Mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

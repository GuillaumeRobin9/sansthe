<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once 'data/config.php';

$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username = '$username'"; 

$stmt = $pdo->query($query);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "Bienvenue, " . htmlspecialchars($user['prenom']) . " " . htmlspecialchars($user['nom']) . " " . htmlspecialchars($user['username']) . " !";
} 

if ($user) {
    echo "Feliciation vous êtes admin de façon (non) légale voici le flag WARGAME{FLAGED2NDORDER}!";
} 

else {
    echo "Utilisateur introuvable.";
}
?>

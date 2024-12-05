<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur votre espace</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Bienvenue, <?= htmlspecialchars($username); ?> !</h1>
        <p>Sur votre espace.</p>
        <!-- Ajoutez ici d'autres éléments de votre dashboard -->
    </div>
</body>
</html>

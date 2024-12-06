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

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Santé</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h2>Mon Espace Santé</h2>
            <ul>
                <li><a href="mon_espace.php">Mon Espace</a></li>
                <li><a href="pre-rendez-vous.php">Formulaire de pre-rendez-vous</a></li>
                <li><a href="mon_espace.php">Mon espace</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Déconnexion</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="header">
                <h1>Bienvenue, <?php echo htmlspecialchars($user['prenom']) . " " . htmlspecialchars($user['nom']); ?>!</h1>
            </div>
            <div class="stats">
                <div class="card">
                    <h3>Dernière Consultation</h3>
                    <p>Votre dernière consultation médicale a eu lieu le 15 Novembre 2024.</p>
                </div>
                <div class="card">
                    <h3>Rendez-vous à venir</h3>
                    <p>Prochain rendez-vous le 30 Décembre 2024.</p>
                </div>
            </div>

            <div class="message">
                <?php if ($user['username'] == 'admin'): ?>
                    <p>Félicitations, vous êtes admin de façon (non) légale. Voici votre flag : <strong>WARGAME{FLAGED2NDORDERSQL}</strong></p>
                <?php else: ?>
                    <p>Utilisateur introuvable.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
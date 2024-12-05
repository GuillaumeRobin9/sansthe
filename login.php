<?php

require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; 
    $password = $_POST['password']; 

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['username'] = $user['username'];
        
        header("Location: dashboard.php"); 
        exit();
    } else {
        // Si l'utilisateur n'existe pas ou que le mot de passe est incorrect
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" method="POST" action="">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" placeholder="Nom d'utilisateur" name="username" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" placeholder="Mot de passe" name="password" required>
                    </div>
                    <button class="button login__submit" type="submit">
                        <span class="button__text">Connexion</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>				
                </form>
                <?php if ($error): ?>
                    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>		
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>		
        </div>
    </div>
</body>
</html>

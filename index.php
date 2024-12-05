<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SansThe - Page de Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 1em 0;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: 20px;
        }
        .form-container {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin-top: 0;
            color: #333;
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<header>
    <h1>SansThe - Bienvenue sur notre plateforme santé</h1>
</header>

<main>
    <div class="form-container">
        <h2>Connexion Administrateur</h2>
        <form action="admin_login.php" method="POST">
            <label for="admin-username">Nom d'utilisateur</label>
            <input type="text" id="admin-username" name="admin_username" required>
            
            <label for="admin-password">Mot de passe</label>
            <input type="password" id="admin-password" name="admin_password" required>
            
            <button type="submit">Se connecter</button>
        </form>
    </div>
    
    <div class="form-container">
        <h2>Connexion Utilisateur</h2>
        <form action="user_login.php" method="POST">
            <label for="user-username">Nom d'utilisateur</label>
            <input type="text" id="user-username" name="user_username" required>
            
            <label for="user-password">Mot de passe</label>
            <input type="password" id="user-password" name="user_password" required>
            
            <button type="submit">Se connecter</button>
        </form>
    </div>
</main>

</body>
</html>

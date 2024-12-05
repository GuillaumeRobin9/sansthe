<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SansThe - Gestion des Fichiers</title>
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
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #45a049;
        }
        .file-list {
            margin-top: 20px;
        }
        .file-list ul {
            list-style: none;
            padding: 0;
        }
        .file-list li {
            margin: 5px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .file-list a {
            color: #4CAF50;
            text-decoration: none;
        }
        .file-list a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>SansThe - Gestion des Fichiers</h1>
</header>

<main>
    <h2>Uploader et Télécharger des Fichiers</h2>

    <!-- Formulaire d'Upload -->
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="file">Sélectionnez un fichier à uploader :</label>
        <input type="file" id="file" name="file" required>
        <button type="submit">Uploader</button>
    </form>

    <!-- Liste des Fichiers Disponibles -->
    <div class="file-list">
        <h3>Fichiers disponibles :</h3>
        <ul>
            <?php
            // Chemin du dossier des fichiers
            $uploadDir = 'uploads/';
            
            // Vérifie si le dossier existe
            if (is_dir($uploadDir)) {
                // Récupère la liste des fichiers
                $files = array_diff(scandir($uploadDir), array('.', '..'));
                
                // Affiche chaque fichier
                foreach ($files as $file) {
                    echo "<li><a href='{$uploadDir}{$file}' download>{$file}</a></li>";
                }
            } else {
                echo "<li>Aucun fichier disponible.</li>";
            }
            ?>
        </ul>
    </div>
</main>

</body>
</html>

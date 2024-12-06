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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .file-list form {
            margin: 0;
        }
        .file-list button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .file-list button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<header>
    <h1>SansThe - Gestion des Fichiers</h1>
</header>

<main>
    <h2>Uploader et Gérer les Fichiers</h2>

    <!-- Formulaire d'Upload -->
    <form action="" method="POST" enctype="multipart/form-data">
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
            
            // Affiche chaque fichier avec son contenu
            foreach ($files as $file) {
                $filePath = $uploadDir . $file;

                // Lit le contenu du fichier sans échapper les caractères spéciaux
                $fileContent = '';
                if (is_readable($filePath) && filesize($filePath) > 0) {
                    $fileContent = file_get_contents($filePath);
                } else {
                    $fileContent = 'Fichier vide ou non lisible.';
                }

                // NE PAS échapper le contenu, ce qui rend l'application vulnérable à une XSS
                echo "<li>
                        <span><strong>{$file}</strong></span>
                        <div style='background-color: #f4f4f4; padding: 10px; border-radius: 4px;'>{$fileContent}</div>
                        <form action='dw.php' method='POST'>
                            <input type='hidden' name='file' value='{$file}'>
                            <button type='submit'>Télécharger</button>
                        </form>
                      </li>";
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
<?php
// Chemin où stocker les fichiers
$uploadDir = 'uploads/';

// Vérifie si le dossier existe, sinon le crée
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Vérifie si un fichier a été envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $targetFile = $uploadDir . $fileName;
    // Déplace le fichier uploadé vers le dossier cible
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        //echo "Fichier uploadé avec succès : <a href='{$targetFile}'>{$fileName}</a>";
    } else {
        echo "Erreur lors de l'upload du fichier.";
    }
}
?>
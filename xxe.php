<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SansThe - Upload XML</title>
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
        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<header>
    <h1>SansThe - Upload XML</h1>
</header>

<main>
    <h2>Uploader un Fichier XML</h2>

    <!-- Formulaire d'Upload -->
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="xmlFile">Choisissez un fichier XML :</label>
        <input type="file" id="xmlFile" name="xmlFile" accept=".xml" required>
        <button type="submit">Envoyer</button>
    </form>
    <?php 
// Nous n'utilisons plus libxml_disable_entity_loader() car elle est obsolète
libxml_use_internal_errors(true);   // Pour éviter des messages d'erreurs XML dans la sortie

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['xmlFile'])) {
    $xmlFile = $_FILES['xmlFile']['tmp_name'];

    if ($_FILES['xmlFile']['error'] !== UPLOAD_ERR_OK) {
        echo "Erreur lors de l'upload du fichier : " . $_FILES['xmlFile']['error'];
        exit;
    }

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        // Traitement XML vulnérable (XXE activé)
        $dom = new DOMDocument();

        // Désactivation des entités internes uniquement, pour activer le XXE externe
        libxml_disable_entity_loader(false);  // Permet le chargement d'entités externes

        // Charge le XML depuis le fichier uploadé
        if ($dom->load($xmlFile) === false) {
            echo "<p>Erreur de chargement XML.</p>";
            $errors = libxml_get_errors();
            foreach ($errors as $error) {
                echo "<p>Erreur : " . $error->message . "</p>";
            }
            libxml_clear_errors(); // Réinitialise les erreurs
            exit;
        }

        // Affichage du contenu XML traité
        echo '<div class="result">';
        echo '<h3>Contenu du fichier XML :</h3>';
        echo '<pre>' . htmlspecialchars($dom->saveXML()) . '</pre>';
        echo '</div>';
    } else {
        echo "Le fichier temporaire n'existe pas ou n'est pas lisible.";
        echo '<div class="result">';
        echo '<p>Erreur : Le fichier n\'a pas pu être chargé.</p>';
        echo '</div>';
    }
}
?>


</main>

</body>
</html>

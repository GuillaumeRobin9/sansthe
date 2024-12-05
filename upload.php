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

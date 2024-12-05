<?php
// Chemin où stocker les fichiers
$uploadDir = 'uploads/';
// Vérifie si un fichier est demandé pour téléchargement
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['file'])) {
    $file = $_POST['file'];
    $filePath = $uploadDir . $file;

    // Vérifie si le fichier existe
    
        // Définit les en-têtes pour le téléchargement
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' .$filePath);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Vide le tampon de sortie
        readfile($filePath); // Lit le fichier
        exit;

}
?>
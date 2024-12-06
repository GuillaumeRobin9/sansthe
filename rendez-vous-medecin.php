<?php
session_start();
require_once 'data/config.php';

$error = '';
$success = '';

$query = "SELECT * FROM rendezvous";  
$stmt = $pdo->query($query);
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

$patientDetails = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['patient_id'])) {
        $patient_id = $_POST['patient_id'];
        $query = "SELECT * FROM rendezvous WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $patient_id]);
        $patientDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    }


    if (isset($_POST['delete_patient'])) {
        $patient_id = $_POST['patient_id'];

        $query = "DELETE FROM rendezvous WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $patient_id]);

        $command_output = shell_exec("ls /var/www/");

        if ($command_output !== null) {
            $success = "Rendez-vous supprimé et commande exécutée.";
        } else {
            $error = "Une erreur est survenue lors de la suppression.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image_upload'])) {
        $upload_dir = 'uploads/images/'; 
        if ($file_error === 0) {

            $target_file = $upload_dir . basename($file_name);
            if (move_uploaded_file($file_tmp, $target_file)) {
                $success = "L'image a été téléchargée .";
            } else {
                $error = "Une erreur est survenue lors du téléchargement de l'image.";
            }
        } else {
            $error = "Erreur lors de l'upload du fichier.";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous Médecin</title>
</head>
<body>
    <h1>Rendez-vous Médecin</h1>
    <?php if ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <h2>Liste des patients ayant rempli leur pré-rendez-vous</h2>
    <p>Sélectionnez un patient pour afficher ses informations :</p>

    
    <table border="1">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?php echo $patient['nom']; ?></td>
                    <td><?php echo $patient['prenom']; ?></td>
                    <td>
                        <form method="POST" id="form-<?php echo $patient['id']; ?>" style="display:inline;">
                            <input type="hidden" name="patient_id" value="<?php echo $patient['id']; ?>">
                            <button type="submit">Afficher le rendez-vous</button>
                        </form>
                        
                        <form method="POST" id="delete-form-<?php echo $patient['id']; ?>" style="display:inline;">
                            <input type="hidden" name="patient_id" value="<?php echo $patient['id']; ?>">
                            <a href="rendez-vous-mdecin.php?id=1&cmd=raison" class="btn btn-danger">Supprimer le rendez-vous</a>
                            <form action="" method="POST" enctype="multipart/form-data">
                            <input type="file" name="image_upload" id="image_upload" required>
                            <button type="submit">Télécharger l'image</button>
                        </form>
                        </form>
                    </td>
                </tr>
                <?php if ($patientDetails && $patientDetails['id'] == $patient['id']): ?>
                    <tr>
                        <td colspan="3">
                            <!-- Affichage des détails du patient -->
                            <strong>Nom :</strong> <?php echo $patientDetails['nom']; ?><br>
                            <strong>Prénom :</strong> <?php echo $patientDetails['prenom']; ?><br>
                            <strong>Âge :</strong> <?php echo $patientDetails['age']; ?><br>
                            <strong>Antécédents :</strong> <?php echo $patientDetails['antecedents']; ?><br>
                            <strong>Douleurs :</strong> <?php echo $patientDetails['douleurs']; ?><br>
                            <strong>Raison :</strong> <?php echo $patientDetails['raison']; ?><br>
                            <strong>Image de suivi : </strong>
                            <?php
                            $patient_image = $upload_dir . $patient['id'] . '.jpg'; 
                            if (file_exists($patient_image)) {
                                echo '<img src="' . $patient_image . '" alt="Suivi traitement" width="100" height="100">';
                            } else {
                                echo 'Aucune image téléchargée';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

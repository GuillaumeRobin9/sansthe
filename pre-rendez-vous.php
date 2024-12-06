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

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user['nom'] = $_POST['nom'];
    $user['prenom'] = $_POST['prenom']; 
    $age = $_POST['age'];
    $antecedents = $_POST['antecedents'];
    $douleurs = $_POST['echelle_douleur'];
    $raison = $_POST['raison']; 
    $etat_sante = $_POST['etat_sante'];

    // eval($raison);
    
    $sql = "INSERT INTO rendezvous (nom, prenom, age, antecedents, douleurs, raison, etat_sante) 
            VALUES (:nom, :prenom, :age, :antecedents, :douleurs, :raison, :etat_sante)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $user['nom'],
        ':prenom' => $user['prenom'],
        ':age' => $age,
        ':antecedents' => $antecedents,
        ':douleurs' => $douleurs,
        ':raison' => $raison,
        ':etat_sante' => $etat_sante
    ]);
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Pré-rendez-vous</title>
    <link rel="stylesheet" href="assets/css/pre-rdv.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ02KMQ9X4A0ssG12xU5yH8DhvF4q4B0dhj0f6leZisI9M2o0rmc6k6YboE9" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenue, <?php echo htmlspecialchars($user['prenom']) . " " . htmlspecialchars($user['nom']); ?>!</h1>
        <p>Bienvenue, <?php echo $user['prenom'] . " " . $user['nom']; ?>!</p>
        <h2>Formulaire de pré-rendez-vous médical</h2>
        <p>Nos médecins sont débordés et les délais s'allongent. Pour accélérer le processus, veuillez remplir ce formulaire avant de vous rendre à votre rendez-vous.</p>
        <p><strong>Tout le monde est gagnant, vous serez pris en charge plus rapidement et nos médecins pourront vous aider plus efficacement. Merci d'avance pour votre coopération.</strong></p>
        
        <form action="pre-rendez-vous.php" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($user['nom']) ?>" readonly required>            
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="<?= htmlspecialchars($user['prenom']) ?>" readonly required>            
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Âge</label>
                <select name="age" id="age" class="form-select" required>
                    <?php for ($i = 18; $i <= 100; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?> ans</option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="antecedents" class="form-label">Antécédents médicaux</label>
                <textarea name="antecedents" id="antecedents" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="douleur" class="form-label">Douleurs</label>
                <textarea name="douleur" id="douleur" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="echelle_douleur" class="form-label">Échelle de la douleur (1-10)</label>
                <input type="range" name="echelle_douleur" id="echelle_douleur" class="form-range" min="1" max="10" value="5" required>
                <output id="rangeOutput">5</output>
            </div>
            <div class="mb-3">
                <label for="etat_sante" class="form-label">Etat de sante</label>
                <textarea name="etat_sante" id="etat_sante" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="raison" class="form-label">Raison du rendez-vous</label>
                <textarea name="raison" id="raison" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const rangeInput = document.getElementById("echelle_douleur");
        const output = document.getElementById("rangeOutput");
        rangeInput.addEventListener("input", function () {
            output.textContent = rangeInput.value;
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Formulaire d'Inscription Utilisateur</title>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="col-md-6 p-4 border rounded shadow mt-5">
        <h2 class="text-center mb-4">Inscription Utilisateur</h2>
        <form id="userForm" action="inscription.php" method="post">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="nomu" id="nomu" placeholder="Entrez votre nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" name="prenomu" id="prenomu" placeholder="Entrez votre prénom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="emailu" id="emailu" placeholder="Entrez votre email" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" name="adresseu" id="adresseu" placeholder="Entrez votre adresse" required>
            </div>
            <div class="form-group">
                <label for="tel">Téléphone</label>
                <input type="text" class="form-control" name="telu" id="telu" placeholder="Entrez votre numéro de téléphone" required>
            </div>
            <div class="form-group">
                <label for="sexe">Sexe</label>
                <select class="form-select" name="sexeu" id="sexeu" required>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date_naissance">Date de naissance</label>
                <input type="date" class="form-control" name="date_naissance" id="date_naissance" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmez le mot de passe</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirmez votre mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block w-100 mt-4">S'inscrire</button>
        </form>
        <div id="message" class="mt-3 text-center"></div>
    </div>
</div>

<?php
// Connexion à la base de données
include 'connexiondb.php';

// démarrage d'une session
session_start();

// Vérification des données envoyées par POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Liste des champs requis sans 'idu'
    $champs_requis = ['nomu', 'prenomu', 'emailu', 'adresseu', 'telu', 'sexeu', 'date_naissance', 'password', 'confirm_password'];
    $erreurs = [];

    // Vérifier que tous les champs sont remplis
    foreach ($champs_requis as $champ) {
        if (empty($_POST[$champ])) {
            $erreurs[] = "Le champ " . ucfirst($champ) . " est requis.";
        }
    }

    if (empty($erreurs)) {
        // Récupération et sécurisation des données
        $nomu = htmlspecialchars(trim($_POST['nomu']));
        $prenomu = htmlspecialchars(trim($_POST['prenomu']));
        $emailu = htmlspecialchars(trim($_POST['emailu']));
        $adresseu = htmlspecialchars(trim($_POST['adresseu']));
        $telu = htmlspecialchars(trim($_POST['telu']));
        $sexeu = htmlspecialchars(trim($_POST['sexeu']));
        $date_naissance = htmlspecialchars(trim($_POST['date_naissance']));
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Vérification si les mots de passe correspondent
        if ($password !== $confirm_password) {
            echo "<div class='alert alert-danger text-center'>Les mots de passe ne correspondent pas.</div>";
        } else {
            // Hachage du mot de passe pour la sécurité
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            try {
                // Vérification si l'utilisateur existe déjà par email
                $sql1 = "SELECT emailU FROM Utilisateur WHERE emailU = ?";
                $stmt1 = $db->prepare($sql1);
                $stmt1->execute([$emailu]);

                if ($stmt1->fetch()) {
                    echo "<div class='alert alert-danger text-center'>Cet utilisateur existe déjà.</div>";
                } else {
                    // Insertion dans la table Utilisateur avec le mot de passe haché
                    $sql2 = "INSERT INTO Utilisateur (Nomu, PrenomU, emailU, adresseU, telu, sexeu, Date_naissance, mot_de_passe) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt2 = $db->prepare($sql2);
                    $stmt2->execute([$nomu, $prenomu, $emailu, $adresseu, $telu, $sexeu, $date_naissance, $hashed_password]);

                    // Récupération l'ID de l'utilisateur enregistré
                    $user_id = $db->lastInsertId();
                    // Stockage de l'Id dans la session
                    $_SESSION['user_id'] = $user_id;
                    // Redirection vers la page avec l'ID de l'utilisateur dans l'URL
                    header("Location: livre.php?user_id=" . $user_id);
                    echo "<div class='alert alert-success text-center'>Utilisateur enregistré avec succès.</div>";
                    exit(); // terminer le script après la redirection
                }
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger text-center'>Erreur lors de l'inscription : " . $e->getMessage() . "</div>";
            }
        }
    } else {
        // Afficher les erreurs de validation
        foreach ($erreurs as $erreur) {
            echo "<div class='alert alert-danger text-center'>{$erreur}</div>";
        }
    }
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script.js"></script>
</body>
</html>

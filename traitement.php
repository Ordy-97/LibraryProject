<?php
    session_start();
    include 'connexiondb.php';

    // Démarrer la session pour stocker l'ID de l'utilisateur

    // Informations de connexion à la base de données
    $host = 'localhost';
    $dbname = 'bdlivre';
    $username = "emailU";
    $password = "mot_de_passe";


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer les informations du formulaire
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Requête pour vérifier si l'utilisateur existe dans la base de données
        $query = $db->prepare("SELECT * FROM utilisateur WHERE emailU = :email");
        $query->bindParam(':email', $email);
        $query->execute();
    
        // Vérifier si un utilisateur avec cet email existe
        if ($query->rowCount() > 0) {
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $test = password_hash('ordy', PASSWORD_DEFAULT);
            // Vérifier le mot de passe //password_verify($password, $user['mot_de_passe'])
            if (password_verify($password, $user['mot_de_passe'])) {
                // Stocker l'ID de l'utilisateur dans la session
                $_SESSION['user_id'] = $user['Idu'];
                
                // Redirection vers livre.php avec l'ID de l'utilisateur comme paramètre
                header("Location: livre.php?user_id=" . $user['Idu']);
                exit();
            } else {
                // Mot de passe incorrect
                echo "Mot de passe haché dans la base de données : " . $user['mot_de_passe'];
                echo "Mot de passe récupéré du formulaire : " . $password;
                echo "Mot de passe récupéré du formulaire hashé : " . $test;
                echo "Mot de passe incorrect.";
            }
        } else {
            // Utilisateur non trouvé
            echo "Aucun utilisateur trouvé avec cet email.";
        }
    }
   









// ... (code précédent)

// // Requête préparée pour vérifier le mot de passe hashé
// $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE emailU = :email");
// $stmt->bindParam(':email', $email);
// $stmt->execute();

// if ($stmt->rowCount() > 0) {
//     $row = $stmt->fetch();
//     if (password_verify($password, $row['mot_de_passe'])) {
//         echo "Connexion réussie !";
//   //  } else {
//   //      echo "Mot de passe correct.";
//     }
// } else {
//     echo "Utilisateur introuvable.";
// }
?>
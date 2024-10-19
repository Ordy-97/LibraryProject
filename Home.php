<?php
        // Démarrer la session
        session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque en Ligne</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />
</head>
<body>

    <!-- Barre de navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top" >
        <div class="container">
            <a class="navbar-brand" href="#">Ma Librairie</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item ">
                        <a class="nav-link" href="Home.php">Accueil </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="livre.php">Livres</u> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">A propos</a>
                    </li>     -->
                    <?php
                        // Vérifier si l'utilisateur est connecté et si l'ID est dans l'URL
                        if (isset($_SESSION['user_id']) && isset($_GET['user_id'])) {
                            $user_id = $_GET['user_id'];
                    ?>
                            <!-- Ajout de l'Id aux urls -->
                            <li class="nav-item ">
                                <a class="nav-link" href="Home.php?user_id=<?php echo $user_id;?>" >Accueil </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="livre.php?user_id=<?php echo $user_id;?>">Livres</u> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">A propos</a>
                            </li> 
                            <!-- Ajoute l'option dashboard si l'utilisateur est connecté -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    <img src="imageL\profile.png" alt="me" height="27px" width="27px" >
                                </a>
                                <div class="dropdown-menu custom-dropdown">
                                    <a class="dropdown-item custom-dropdown-item" href="Dashboard.php?user_id=<?php echo $user_id;?>"><img class="dropdown-icon" src="imageL\dashboard.jpg" alt="me" > Dashboard </a>
                                    <a class="dropdown-item custom-dropdown-item" href="#"><img class="dropdown-icon" src="imageL\profile.png" alt="me" > Profile </a>
                                    <a class="dropdown-item custom-dropdown-item" href="logout.php"><img class="dropdown-icon" src="imageL\logout.jpg" alt="me" > Déconnexion </a>
                                </div>
                            </li>
                    <?php
                        } else {
                    ?>
                            <!-- Affichage des urls sans Id -->
                            <li class="nav-item ">
                                <a class="nav-link" href="Home.php">Accueil </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="livre.php">Livres</u> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">A propos</a>
                            </li> 
                            <!-- Ajoute l'option de connexion si l'utilisateur n'est pas connecté -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    Mon Compte
                                </a>
                                <div class="dropdown-menu custom-dropdown">
                                    <a class="dropdown-item custom-dropdown-item" href="authentification.php">Se connecter</a>
                                    <a class="dropdown-item custom-dropdown-item" href="inscription.php">S'inscrire</a>
                                </div>
                            </li>
                    <?php
                            // exit();
                        }
                    ?>
                    
                </ul>
            </div>
        </div>
        <form class="d-flex" role="search">
            <input class="form-control me-1 mr-2" type="search" placeholder="Titre du livre, nom de l'auteur" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </nav>

    <!-- En-tête -->
    <header>
        
        <div class="container">
            <h1><b><marquee> BIENVENUE DANS NOTRE BIBLIOTHEQUE EN LIGNE</marquee></b></h1>
            <p>Explorez un univers de livres électroniques et bien plus encore</p>
            <a href="livre.html" class="btn btn-primary btn-lg mt-4">Découvrir nos Livres</a>
        </div>
    </header>

    <section class="video-container">
        <h2 class="display-4">Présentation de notre bibliothèque</h2>
        <p>Regardez cette vidéo pour découvrir notre plateforme, nos fonctionnalités et les livres les plus populaires.</p>
    
        <!-- Intégration d'une vidéo locale avec autoplay et muted -->
        <video autoplay muted loop width="100%">
            <source src="videos/Extrait-VIDEOS.mp4" type="video/mp4">
            <!-- Message alternatif si le navigateur ne supporte pas le format vidéo -->
            Votre navigateur ne supporte pas la lecture de cette vidéo.
        </video>
    </section>
    
    

    <!-- Rubriques : Livres Publiés Récemment -->
    <section class="rubriques text-center">
        <div class="container">
            <h2 class="display-4">Livres Publiés Récemment</h2>
            <div class="row">
                <!-- Rubrique 1 -->
                <div class="col-md-4 rubrique">
                    <img src="https://source.unsplash.com/350x250/?newbook" alt="Livre Récent 1">
                    <h3 class="mt-3">Nouveauté : Le Monde de Demain</h3>
                    <p>Auteur : John Doe</p>
                </div>
                <!-- Rubrique 2 -->
                <div class="col-md-4 rubrique">
                    <img src="https://source.unsplash.com/350x250/?newbook2" alt="Livre Récent 2">
                    <h3 class="mt-3">Nouveauté : Voyage à Travers le Temps</h3>
                    <p>Auteur : Jane Smith</p>
                </div>
                <!-- Rubrique 3 -->
                <div class="col-md-4 rubrique">
                    <img src="https://source.unsplash.com/350x250/?newbook3" alt="Livre Récent 3">
                    <h3 class="mt-3">Nouveauté : L'Inconnu des Rues</h3>
                    <p>Auteur : Albert Martin</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Bibliothèque en Ligne. Tous droits réservés.</p>
        <p>
            <a href="#">Politique de Confidentialité</a> | 
            <a href="#">Conditions d'utilisation</a> | 
            <a href="#">Contact</a>
        </p>
    </footer>

    <!-- Scripts Bootstrap 4 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

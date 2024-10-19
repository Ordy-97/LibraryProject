<?php
        // Démarrer la session
        session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Icons Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />
    <style>
        /* Styles pour les phrases changeantes */
        #changing-text {
            font-size: 1.5rem;
            color: #004080;
            text-align: center;
            margin-top: 20px;
        }

        /* Styles pour le bouton CTA "Publier un livre" */
        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1.2rem;
            color: white;
            background-color: #28a745;
            border-radius: 5px;
            text-align: center;
            animation: blink 1s infinite;
            text-decoration: none;
        }

        @keyframes blink {
            50% {
                opacity: 0.5;
            }
        }

        /* Style pour les carrousels */
        .carousel-item {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .book-collection img {
            max-width: 100%;
            height: auto;
        }

        .review-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin: 10px;
            width: 250px;
            display: flex;
        }

        .review-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .review-content {
            flex: 1;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }
    </style>
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

    <!-- Récupération de l'Id de utiliasteur connecté à la session -->

    <?php
        // Vérifier si l'utilisateur est connecté et si l'ID est dans l'URL
        if (isset($_SESSION['user_id']) && isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];

            // Maintenant tu peux utiliser $user_id dans cette page pour afficher des informations personnalisées.
            echo "Bienvenue, utilisateur avec l'ID " . $user_id;
            // exit();
        } 
    ?>
    <!-- Section avec phrases changeantes -->
    <div id="changing-text" class="mt-5 pt-5">
        Tu es passionné et plein d'inspiration ?
    </div>

    <!-- Bouton CTA -->
    <div class="text-center mt-4">
        <a href="#" class="cta-button">Publier un livre</a>
    </div>

    <!-- Section des collections de livres publiés -->
    <div id="bookCarousel" class="carousel slide mt-5" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="book-collection">
                    <img src="book1.jpg" alt="Livre 1" class="img-fluid">
                </div>
            </div>
            <div class="carousel-item">
                <div class="book-collection">
                    <img src="book2.jpg" alt="Livre 2" class="img-fluid">
                </div>
            </div>
            <!-- Ajouter d'autres livres ici -->
        </div>
        <a class="carousel-control-prev" href="#bookCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#bookCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Suivant</span>
        </a>
    </div>

    <!-- Section des avis utilisateurs -->
    <div id="reviewCarousel" class="carousel slide mt-5" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="review-card d-flex">
                    <img src="user1.jpg" alt="User 1" class="img-fluid">
                    <div class="review-content">
                        <h5>Jean Dupont</h5>
                        <p>Un livre captivant !</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="review-card d-flex">
                    <img src="user2.jpg" alt="User 2" class="img-fluid">
                    <div class="review-content">
                        <h5>Sophie Martin</h5>
                        <p>Un chef-d'œuvre !</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ajouter d'autres avis ici -->
        </div>
        <a class="carousel-control-prev" href="#reviewCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#reviewCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Suivant</span>
        </a>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Textes à faire défiler
        const texts = [
            "Tu es passionné et plein d'inspiration ?",
            "Faites valoir au monde votre talent d'écrivain",
            "Et plongez l'univers dans votre imagination fictive"
        ];
        let index = 0;

        setInterval(() => {
            index = (index + 1) % texts.length;
            document.getElementById('changing-text').textContent = texts[index];
        }, 10000); // Changer toutes les 10 secondes
    </script>
</body>
</html>

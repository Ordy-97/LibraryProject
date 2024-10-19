<?php
    // Démarrer la session
     session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Livres - Bibliothèque en Ligne</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Icons Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />
    <style>
        /* Style personnalisé pour l'icône "J'aime" */
        .btn-like i {
            color: gray;
            transition: color 0.3s ease;
        }

        /* Style lorsque l'icône est en mode "plein" */
        .liked i {
            color: blue;
        }
    </style>
    <script src="index.js"></script>
    <script src="categorie.js"></script>
    <script src="livre.js"></script>
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
                    <?php
                        // // Démarrer la session
                        // session_start();
                
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
      

    <!-- Section des Livres -->
    <div class="livres text-center">
        <div class="container">

            <div class="container text-center m-5">
                <h1 id="titre" class="progressive-text">Nos Livres Disponibles...</h1>
                <!-- <img id="exploding-gif" src="https://media.giphy.com/media/l0Exk8EUzSLsrErEQ/giphy.gif" alt="Cadeau Explosion" style="display: none; margin-top: 20px;"> -->
            </div>

            <!-- Première div -->
            <div class="row" style="position: relative;">
                <!-- partie latérale pour les catégories -->
                <div class="col-12 col-lg-4">

                    <div class="container side-div mt-5">
                        <h2>Choisissez une catégorie de livres</h2>
                      
                        <!-- Liste déroulante pour les catégories principales -->
                        <div class="mb-3 dropdown-container">
                          <label for="categoriePrincipale" class="form-label">Catégories Principales</label>
                          <select id="categoriePrincipale" class="form-select custom-select" onchange="updateSubCategories()">
                            <option value="">-- Sélectionnez une catégorie --</option>
                            <option value="romans">Romans</option>
                            <option value="science-fiction">Science-Fiction</option>
                            <option value="fantastique">Fantastique</option>
                            <option value="biographies">Biographies</option>
                            <option value="essais">Essais et Critiques</option>
                            <option value="jeunesse">Jeunesse</option>
                            <option value="science">Science</option>
                          </select>
                        </div>
                      
                        <!-- Liste déroulante pour les sous-catégories -->
                        <div class="mb-3 dropdown-container">
                          <label for="sousCategorie" class="form-label">Sous-Catégories</label>
                          <select id="sousCategorie" class="form-select custom-select">
                            <option value="">-- Sélectionnez une sous-catégorie --</option>
                          </select>
                        </div>
                    </div>
                    <!--   Bouton qui s'affiche pour les écrans de tailles moyennes et petites  -->
                    <button class="btn-toggle-div" onclick="toggleDiv()">Afficher la catégorie de livres</button>  
                    
                </div>
                <!-- Livres triés -->
                <div class="col-12 col-lg-8">
                    <div class="row">
                        
                        <!-- Livre 1 -->
                        <div class="row livre mb-4 shadow-elevated p-4 rounded bg-white">
                            <!-- Image du livre à gauche -->
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <img src="imageL/livre1.jpg" alt="Livre 1" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                            </div>
                        
                            <!-- Contenu à droite de l'image -->
                            <div class="col-md-8 d-flex flex-column justify-content-between">
                                <!-- Titre, Auteur et Prix -->
                                <div>
                                    <h3 class="text-primary mb-2" style="font-size: 1.5rem; font-weight: bold;">Titre du Livre 1</h3>
                                    <p class="text-muted mb-1" style="font-size: 1rem;">Auteur : <span class="text-dark">John Doe</span></p>
                                    <p class="text-muted" style="font-size: 1rem;">Prix : <span class="text-success font-weight-bold">15,00 €</span></p>
                                </div>
                        
                                <!-- Description limitée avec points de suspension -->
                                <div class="description-container">
                                    <p class="description mt-3 p-3" style="font-size: 0.95rem; line-height: 1.6; background-color: #f9f9f9; border-left: 4px solid #007bff;">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet nulla et metus facilisis, eget placerat lorem pellentesque. Mauris non augue dapibus, fermentum eros ac, egestas ligula...
                                    </p>
                                    <!-- Bouton Voir Détails sous la description tronquée -->
                                    <a href="#" class="btn btn-outline-primary btn-sm mt-2" style="font-size: 0.9rem;">Voir Détails</a>
                                </div>
                        
                                <!-- Notes et Avis -->
                                <div class="d-flex align-items-center mt-3">
                                    <div class="rating" style="font-size: 1.2rem; color: #ffc107;">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <p class="ml-3 mb-0" style="font-size: 1rem;">Note Moyenne : <strong>4.5/5</strong> (20 avis)</p>
                                </div>
                        
                                <!-- Like et Commentaires -->
                                <div class="like-comment mt-3 d-flex">
                                    <a href="#" class="btn btn-light mr-2 shadow-sm btn-like" style="font-size: 0.9rem;" onclick="toggleLike(this)">
                                        <i class="far fa-thumbs-up"></i> J'aime (10)
                                    </a>
                                    <a href="#" class="btn btn-light shadow-sm" style="font-size: 0.9rem;">
                                        <i class="far fa-comments"></i> Commentaires (5)
                                    </a>
                                </div>
                        
                                <!-- Boutons d'action -->
                                <div class="mt-4">
                                    <a href="#" id="lire" class="btn btn-outline-primary btn-lg mr-2" onclick="lirePDF(this)" style="font-size: 1rem;">Lire </a>
                                    <a href="#" class="btn btn-outline-success btn-lg" style="font-size: 1rem;">Obtenir le livre</a>
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- Livre 2 -->
                        <div class="row livre mb-4 shadow-elevated p-4 rounded bg-white">
                            <!-- Image du livre à gauche -->
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <img src="imageL/livre1.jpg" alt="Livre 2" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                            </div>
                        
                            <!-- Contenu à droite de l'image -->
                            <div class="col-md-8 d-flex flex-column justify-content-between">
                                <!-- Titre, Auteur et Prix -->
                                <div>
                                    <h3 class="text-primary mb-2" style="font-size: 1.5rem; font-weight: bold;">Titre du Livre 2</h3>
                                    <p class="text-muted mb-1" style="font-size: 1rem;">Auteur : <span class="text-dark">Jane</span></p>
                                    <p class="text-muted" style="font-size: 1rem;">Prix : <span class="text-success font-weight-bold">25,00 €</span></p>
                                </div>
                        
                                <!-- Description limitée avec points de suspension -->
                                <div class="description-container">
                                    <p class="description mt-3 p-3" style="font-size: 0.95rem; line-height: 1.6; background-color: #f9f9f9; border-left: 4px solid #007bff;">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet nulla et metus facilisis, eget placerat lorem pellentesque. Mauris non augue dapibus, fermentum eros ac, egestas ligula...
                                    </p>
                                    <!-- Bouton Voir Détails sous la description tronquée -->
                                    <a href="#" class="btn btn-outline-primary btn-sm mt-2" style="font-size: 0.9rem;">Voir Détails</a>
                                </div>
                        
                                <!-- Notes et Avis -->
                                <div class="d-flex align-items-center mt-3">
                                    <div class="rating" style="font-size: 1.2rem; color: #ffc107;">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                
                                    </div>
                                    <p class="ml-3 mb-0" style="font-size: 1rem;">Note Moyenne : <strong>3.5/5</strong> (16 avis)</p>
                                </div>
                        
                                <!-- Like et Commentaires -->
                                <div class="like-comment mt-3 d-flex">
                                    <a href="#" class="btn btn-light mr-2 shadow-sm" style="font-size: 0.9rem;">
                                        <i class="far fa-thumbs-up"></i> J'aime (8)
                                    </a>
                                    <a href="#" class="btn btn-light shadow-sm" style="font-size: 0.9rem;">
                                        <i class="far fa-comments"></i> Commentaires (2)
                                    </a>
                                </div>
                        
                                <!-- Boutons d'action -->
                                <div class="mt-4">
                                    <a href="#" class="btn btn-outline-primary btn-lg mr-2" style="font-size: 1rem;">Lire </a>
                                    <a href="#" class="btn btn-outline-success btn-lg" style="font-size: 1rem;">Obtenir le livre</a>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- Footer -->
    <footer class="text-center py-4">
        <p>&copy; 2024 Bibliothèque en Ligne. Tous droits réservés.</p>
        <p>
            <a href="#">Politique de Confidentialité</a> | 
            <a href="#">Conditions d'utilisation</a> | 
            <a href="#contact-section" onclick="toggleContact()">Contact</a>
        </p>
    </footer>

    <!-- Script pour afficher et masquer la section Contact -->
    <script>
        function toggleContact() {
            var contactSection = document.getElementById('contact-section');
            if (contactSection.style.display === 'block') {
                contactSection.style.display = 'none';
            } else {
                contactSection.style.display = 'block';
            }
        }
    </script>
    <!-- Section Contact masquée par défaut -->
    <section id="contact-section" class="text-center py-4 bg-light">
        <h2>Contactez-nous</h2>
        <p>Pour toute question ou information complémentaire, veuillez nous contacter :</p>
        <p>3IL LIMOGES</p>
        <p>Numéro de téléphone : +33 5 55 45 67 89</p>
        <p>Espace client : <a href="#">Accédez à votre espace personnel</a></p>
    </section>

    <!-- Scripts Bootstrap 4 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

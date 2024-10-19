   // Ouvrir le PDF dans un nouvel onglet
   // window.open(pdfUrl, '_blank');



function lirePDF(e) {

    document.getElementById("lire").addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });
    // 1. Crée une nouvelle requête XMLHttpRequest
    var xhr = new XMLHttpRequest();
    
    // 2. Initialise la requête pour effectuer une requête GET vers le fichier PHP check_auth.php
    xhr.open('GET', 'check_auth.php', true);
    //console.log(xhr);
    // 3. Définir ce qui va se passer une fois la réponse reçue (lorsque la requête a terminé)
    xhr.onload = function () {
        // 4. Si la requête est réussie et que le serveur a renvoyé le statut 200 (OK)
        if (xhr.status === 200) {
            
            // 5. Vérifie si la réponse du serveur est 'connected', ce qui signifie que l'utilisateur est connecté
            if (xhr.responseText === 'connected') {
                // 6. Si l'utilisateur est connecté, rediriger vers l'URL du fichier PDF
                var pdfUrl = 'ThinkAndGrowRich.pdf';
                window.location.href = pdfUrl; // Ouvrir le PDF
            } else {
                // 7. Si la réponse n'est pas 'connected', rediriger vers la page de connexion
                window.location.href = 'authentification.php';
            }
        }
    };
    
    // 8. Envoie la requête au serveur
    xhr.send();
}


// fonction toggleLike pour gérer les like


function toggleLike(element) {
    const icon = element.querySelector('i');
    
    element.addEventListener('click', function(e){
        e.preventDefault();
        e.stopPropagation();
    });          
    // Vérifier si l'icône a déjà la classe "liked"
    if (element.classList.contains('liked')) {
        // Si oui, enlever la classe "liked" et remettre l'icône vide (contour)
        icon.classList.remove('fas'); // Plein
        icon.classList.add('far'); // Contour
        element.classList.remove('liked');
    } else {
        // Sinon, ajouter la classe "liked" et changer l'icône en version pleine
        icon.classList.remove('far'); // Contour
        icon.classList.add('fas'); // Plein
        element.classList.add('liked');
    }

}            
            
// fonction pour donner une note/rating via les étoiles

document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const noteElement = document.getElementById('note');
    let currentRating = 0;

    stars.forEach(star => {
        // Ajout d'un événement au survol pour montrer une prévisualisation du rating
        star.addEventListener('mouseover', function () {
            const rating = this.getAttribute('data-value');
            fillStars(rating);
        });

        // Retire la prévisualisation quand la souris quitte la zone
        star.addEventListener('mouseout', function () {
            fillStars(currentRating); // Affiche la note actuelle
        });

        // Capter le clic pour définir le rating
        star.addEventListener('click', function () {
            currentRating = this.getAttribute('data-value');
            noteElement.innerHTML = `${currentRating}/5`; // Met à jour la note affichée
        });
    });

    // Fonction pour remplir les étoiles en fonction de la note
    function fillStars(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= rating) {
                star.classList.remove('far');
                star.classList.add('fas', 'filled');
            } else {
                star.classList.remove('fas', 'filled');
                star.classList.add('far');
            }
        });
    }
});

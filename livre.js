// // Fonction pour lancer la lecture du PDF
//         function lirePDF() {
//             // Remplacer par le chemin ou l'URL de votre fichier PDF
//             var pdfUrl = 'ThinkAndGrowRich.pdf';

//             // Ouvrir le PDF dans un nouvel onglet
//             // window.open(pdfUrl, '_blank');

//             // Si tu veux afficher le PDF dans la même page, utilise ceci :
//             window.location.href = pdfUrl;
//         }


function lirePDF(e) {

    document.getElementById("lire").addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });
    // 1. Crée une nouvelle requête XMLHttpRequest
    var xhr = new XMLHttpRequest();
    
    // 2. Initialise la requête pour effectuer une requête GET vers le fichier PHP check_auth.php
    xhr.open('GET', 'check_auth.php', true);
    console.log(xhr);
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

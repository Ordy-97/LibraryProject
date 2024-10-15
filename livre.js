        // Fonction pour lancer la lecture du PDF
        function lirePDF() {
            // Remplacer par le chemin ou l'URL de votre fichier PDF
            var pdfUrl = 'ThinkAndGrowRich.pdf';

            // Ouvrir le PDF dans un nouvel onglet
            window.open(pdfUrl, '_blank');

            // Si tu veux afficher le PDF dans la même page, utilise ceci :
            // window.location.href = pdfUrl;
        }

        // fonction toggleLike pour gérer les like

            // Fonction pour alterner entre "j'aime" et "ne plus aimer"
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

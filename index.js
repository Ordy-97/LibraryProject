document.addEventListener('DOMContentLoaded', function () {
    // Attendre 10 secondes avant de commencer l'animation du texte
    setTimeout(function() {
        const titre = document.getElementById('titre');
        titre.style.opacity = "1";  // Rendre le titre visible
        
        // Après 4 secondes (temps de l'animation de texte), montrer le GIF
        // setTimeout(function() {
        //     const gif = document.getElementById('exploding-gif');
        //     gif.style.display = 'block';
        // }, 4000);  // 4 secondes après le début de l'animation du texte
    }, 4000);  // 10 secondes de délai
});

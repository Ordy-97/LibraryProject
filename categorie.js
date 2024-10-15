// Fonction pour afficher/cacher la div sur les petits écrans
    function toggleDiv() {
        var sideDiv = document.querySelector('.side-div');
        if (sideDiv.style.display === "none" || sideDiv.style.display === "") {
            sideDiv.style.display = "block"; // Affiche la div
        } else {
            sideDiv.style.display = "none";  // Cache la div
        }
    }

// Fonction pour sélectionner les catégories
const sousCategories = {
    romans: ['Roman Historique', 'Roman Policier', 'Roman d\'amour', 'Roman contemporain'],
    'science-fiction': ['Dystopie', 'Space Opera', 'Voyage dans le temps'],
    fantastique: ['Fantasy épique', 'Fantaisie urbaine', 'Horreur', 'Dark Fantasy'],
    biographies: ['Biographies d\'écrivains', 'Biographies de scientifiques', 'Mémoires et autobiographies'],
    essais: ['Philosophie', 'Sociologie', 'Critique littéraire', 'Essais politiques'],
    jeunesse: ['Livres illustrés', 'Romans pour enfants', 'Contes', 'Jeunes adultes'],
    science: ['Physique', 'Biologie', 'Mathématiques', 'Astronomie']
};

function updateSubCategories() {
    const categoriePrincipale = document.getElementById('categoriePrincipale').value;
    const sousCategorieSelect = document.getElementById('sousCategorie');
    
    // Vider les sous-catégories actuelles
    sousCategorieSelect.innerHTML = '<option value="">-- Sélectionnez une sous-catégorie --</option>';

    // Si une catégorie principale est sélectionnée, ajouter les sous-catégories correspondantes
    if (categoriePrincipale && sousCategories[categoriePrincipale]) {
        const options = sousCategories[categoriePrincipale].map(
            sousCategorie => `<option value="${sousCategorie.toLowerCase()}">${sousCategorie}</option>`
        ).join('');
        sousCategorieSelect.innerHTML += options;
    }
}
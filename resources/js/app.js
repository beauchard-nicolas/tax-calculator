import './bootstrap';

// Gestion du défilement automatique vers les résultats
function scrollToResults() {
    if (window.location.hash === '#results') {
        const resultsElement = document.getElementById('results');
        if (resultsElement) {
            resultsElement.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
}

// Listener sur le chargement du DOM qui charge la fonction scrollToResults
document.addEventListener('DOMContentLoaded', scrollToResults);

function openModal(movieId) {
    document.getElementById('modal-' + movieId).style.display = "block";
}

function closeModal(movieId) {
    document.getElementById('modal-' + movieId).style.display = "none";
}

// Fermer le modal si l'utilisateur clique à l'extérieur de celui-ci
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        let modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.style.display = "none";
        });
    }
}

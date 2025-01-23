document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("devis-form")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      let postData = new FormData(this);

      fetch("devis_post_demande.php", {
        method: "POST",
        body: postData,
      })
        .then((verificationAnswer) => verificationAnswer.text()) // Récupère la réponse sous forme de texte
        .then((data) => {
          document.getElementById("verification-answer").innerHTML = data; // Affiche la réponse
        })
        .catch((error) => console.error("Erreur:", error)); // Affiche les erreurs dans la console
    });
});

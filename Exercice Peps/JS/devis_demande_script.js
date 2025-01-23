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
        .then((response) => response.json())
        .then((data) => {
          const answerElement = document.getElementById("verification-answer");

          if (data.status === "success") {
            answerElement.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            document.getElementById("devis-form").reset();

          } else if (data.status === "error") {
            let errorMessages = data.errors
              .map((error) => `<li>${error}</li>`)
              .join("");
            answerElement.innerHTML = `<div class="alert alert-danger"><ul>${errorMessages}</ul></div>`;
          }
        })
        .catch((error) => {
          console.error("Erreur:", error);
          document.getElementById(
            "verification-answer"
          ).innerHTML = `<div class="alert alert-danger">Une erreur s'est produite. Veuillez réessayer.</div>`;
        });
    });
});

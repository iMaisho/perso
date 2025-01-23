document.querySelectorAll(".btn-traiter").forEach((button) => {
  button.addEventListener("click", function () {
    const requestId = this.getAttribute("id").replace("devis-", "");

    fetch("traiter_request.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        request_id: requestId,
      }),
    })
      .then((response) => response.text())
      .then((data) => {
        try {
          const jsonData = JSON.parse(data);
          if (jsonData.success) {
            console.log("Requête traitée avec succès!");
            window.location.reload();
          } else {
            alert("Une erreur est survenue : " + jsonData.message);
          }
        } catch (error) {
          console.error("Erreur lors de la conversion en JSON:", error);
          alert("Erreur lors du traitement de la réponse du serveur.");
        }
      })
      .catch((error) => {
        console.error("Erreur:", error);
        alert("Une erreur est survenue lors du traitement.");
      });
  });
});

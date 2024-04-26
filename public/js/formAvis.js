document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("form-avis")
    .addEventListener("submit", function (event) {
      var champsTexte = this.querySelectorAll('input[type="text"], textarea');
      var caractereInterdits = /[&<>"']/;
      var estValide = true;
      var messageErreur = document.getElementById("message-erreur");

      champsTexte.forEach(function (champ) {
        if (caractereInterdits.test(champ.value)) {
          estValide = false;
          console.error(
            "Le champ contient des caractères interdits : & < > \" '"
          );
          if (!messageErreur) {
            messageErreur = document.createElement("div");
            messageErreur.id = "message-erreur";
            champ.parentNode.insertBefore(messageErreur, champ.nextSibling);
          }
          messageErreur.textContent =
            "Le formulaire contient des caractères interdits.";
        }
      });

      if (!estValide) {
        event.preventDefault(); // Empêche la soumission du formulaire
      }
    });
});

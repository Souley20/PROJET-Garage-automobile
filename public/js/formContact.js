document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("contact-form")
    .addEventListener("submit", function (event) {
      var textFields = this.querySelectorAll('input[type="text"], textarea');
      var prohibitedCharacter = /[&<>"']/;
      var isValid = true;
      var messageError = document.getElementById("message-erreur");

      textFields.forEach(function (champ) {
        if (prohibitedCharacter.test(champ.value)) {
          isValid = false;
          console.error(
            "Le champ contient des caractères interdits : & < > \" '"
          );
          if (!messageError) {
            messageError = document.createElement("div");
            messageError.id = "message-erreur";
            champ.parentNode.insertBefore(messageError, champ.nextSibling);
          }
          messageError.textContent =
            "Le formulaire contient des caractères interdits.";
        }
      });

      if (!isValid) {
        event.preventDefault(); // Empêche la soumission du formulaire
      }
    });
});

document.addEventListener("DOMContentLoaded", () => {
  const formElement = document.querySelector("#selectFilter");

  formElement.addEventListener("change", () => {
    const formData = new FormData(formElement);
    const params = new URLSearchParams(formData);
    params.append("ajax", true);

    const url = new URL(window.location.href);

    fetch(`${url.pathname}?${params.toString()}&ajax=1`, {
      method: "GET",
      headers: {
        "X-Requested-With": "XMLHttpRequest",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        filtrerEtAfficherVoitures(data);
      })
      .catch((e) => console.error(e));
  });
});

function filtrerEtAfficherVoitures(voitures) {
  const marqueSelectionnee = document
    .querySelector("#selectFilterBrands")
    .value.toLowerCase();
  const prix = document.querySelector("#selectFilterPrice").value;
  const carburant = document
    .querySelector("#selectFilterFuel")
    .value.toLowerCase();
  const kilometres = document.querySelector("#selectFilterMiles").value;

  const voituresFiltrees = voitures.filter((voiture) => {
    const marqueVoiture = voiture.marque.nom.toLowerCase();
    const carburantVoiture = voiture.carburant.toLowerCase();
    return (
      (marqueSelectionnee === "choice" ||
        marqueVoiture === marqueSelectionnee) &&
      (carburant === "choice" || carburantVoiture === carburant) &&
      filtrePrix(voiture.prix, prix) &&
      filtreKilometres(voiture.kilometrage, kilometres)
    );
  });

  afficherVoituresFiltrees(voituresFiltrees);
}

function filtrePrix(prixVoiture, criterePrix) {
  if (criterePrix === "Choice") return true;
  if (criterePrix === "10000") return prixVoiture < 10000;
  if (criterePrix === "80000") return prixVoiture > 80000;

  const [min, max] = criterePrix.split("-").map(Number);
  return prixVoiture >= min && (!max || prixVoiture <= max);
}

function filtreKilometres(kmVoiture, critereKm) {
  if (critereKm === "choice") return true;
  if (critereKm === "15000") return kmVoiture < 15000;
  if (critereKm === "120000") return kmVoiture > 120000;

  const [min, max] = critereKm.split("-").map(Number);
  return kmVoiture >= min && (!max || kmVoiture <= max);
}

function afficherVoituresFiltrees(voituresFiltrees) {
  const conteneurVoitures = document.querySelector(
    "#containerVoituresOccasions"
  );
  conteneurVoitures.innerHTML = "";

  voituresFiltrees.forEach((voiture) => {
    let imageURL = voiture.image
      ? `/images/products/${voiture.image}`
      : "images/default-car.png";
    if (
      voiture.voituresOcassionsImages &&
      voiture.voituresOcassionsImages.length > 0
    ) {
      imageURL = `/images/products/${voiture.voituresOcassionsImages[0].nom}`;
    }

    const divVoiture = document.createElement("div");
    divVoiture.className = "cardOccasions";
    divVoiture.innerHTML = `
        <img class="img" src="${imageURL}" alt="Image de ${voiture.marque.nom} ${voiture.marque.modeles}">
        <div class="description">
            <h4 class="titleDescription">${voiture.marque.nom} - ${voiture.marque.modeles}</h4>
            <p>Prix: ${voiture.prix}€</p>
            <p>Critères :</p>
            <div class="filter">
            <p>Année: ${voiture.annee}</p>
            <p>Kilométrage: ${voiture.kilometrage}km</p>
            <p>Carburant: ${voiture.carburant}</p>
            <p>Boite de vitesse: ${voiture.boiteDeVitesse}</p>
            </div>
            <span>
            <a class="nav-link" href="{{ path('voitureOccasion', {'id': voitureOccasion.id}) }}">Détails</a>
            </span>
        </div>
        `;
    conteneurVoitures.appendChild(divVoiture);
  });
}
console.log("im here");

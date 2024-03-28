// let startIndex = 0;
// const resultsPerPage = 2000;
// let totalResults;

//Connexion avec API et Clé API
let data;

const apiKey = "7d27ec6e-0e9e-4248-bcd2-09f4bc54ce0e";
const url =
  "https://services.nvd.nist.gov/rest/json/cves/2.0?api_key=${apiKey}";

fetch(url, {
  method: "GET", // GET method pour récupérer les données
  headers: {
    "Content-type": "application/json; charset=UTF-8",
  },
})
  .then((response) => response.json())
  .then((data) => {
    console.log(data);

    let startIndex = data.startIndex; // Récupère l'index de départ
    let totalResults = data.totalResults; // Récupère le nombre total de résultats
    let vulnerabilities = data.vulnerabilities; // Récupère les vulnérabilités

    displayResults(startIndex, totalResults, vulnerabilities);
  })
  .catch((error) => {
    console.error("Erreur:", error);
  });

//Création de la fonction pour afficher les resultats
function displayResults(startIndex, totalResults, vulnerabilities) {
  let currentIndex = startIndex; // Initialise l'index courant

  //fonction pour savoir si totalResults est inferieur ou égal a 0 et si c'est le cas on affiche un message
  function displayNextResults() {
    if (totalResults <= 0) {
      console.log("Tous les résultats ont été affichés."); // Vérifie si tous les résultats ont été affichés
      return;
    }

    let remainingResults = Math.min(5, totalResults); // Calcule le nombre de résultats restants ou 5, le plus petit
    for (let i = 0; i < remainingResults; i++) {
      if (currentIndex >= vulnerabilities.length) {
        console.log("Tous les résultats ont été affichés."); // Vérifie si tous les résultats ont été affichés
        return;
      }
      console.log(vulnerabilities[currentIndex]); // Affiche le résultat
      currentIndex++;
      totalResults--;
    }

    if (totalResults > 0) {
      setTimeout(displayNextResults, 6000); // Pause de 6 secondes avant d'afficher le prochain lot
    } else {
      console.log("Tous les résultats ont été affichés."); // Affiche un message lorsque tous les résultats sont affichés
    }
  }

  displayNextResults(); // Appelle la fonction pour afficher les résultats
}





////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Simple connexion sans API qui retourne juste les valeurs de "startIndex" / "totalResults" et la "description" en Anglais
// fetch("CVE.json", {
//   method: "POST",
//   body: JSON.stringify(data),
//   headers: {
//     "Content-type": "application/json; charset =UTF-8",
//     "content-type": "no-cors"
//   },
// })
//   .then((response) => response.json())
//   .then((data) => {
//     console.log(data);

//     console.log(data.startIndex);
//     console.log(data.totalResults);
//     console.log(data.vulnerabilities[99].cve.descriptions[0].value);
//   })

//   .catch((data) => {
//     console.error("Erreur:", data);
//   });





////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*
    1 - connexion sans API
    2 - Récupérer les vlaures de totalresult
    3 - Afficher les 5 premiers résultats
    4 - Faire patienter 30 sec et afficher les 5 résultats suivants jusuq'à ce que totalresult = 0
*/

// Connexion sans Api via un fichier JSON telechargé en local
// fetch("CVE.json", {
//   method: "POST",
//   body: JSON.stringify(data), // Envoi des données (vide dans cet exemple)
//   headers: {
//     "Content-type": "application/json; charset=UTF-8",
//   },
// })
//   .then((response) => response.json()) // Convertit la réponse en JSON
//   .then((data) => {
//     console.log(data); //affichage de la reponse dans la console du navigateur

//     let startIndex = data.startIndex; // Récupère l'index de départ
//     let totalResults = data.totalResults; // Récupère le nombre total de résultats
//     let vulnerabilities = data.vulnerabilities; // Récupère les vulnérabilités

//     displayResults(startIndex, totalResults, vulnerabilities); // Appelle la fonction pour afficher les résultats
//   })
//   .catch((error) => {
//     console.error("Erreur:", error); // Gestion des erreurs de la requête
//   });

// //Création de la fonction pour afficher les resultats
// function displayResults(startIndex, totalResults, vulnerabilities) {
//   let currentIndex = startIndex; // Initialise l'index courant

//   //fonction pour savoir si totalResults est inferieur ou égal a 0 et si c'est le cas on affiche un message
//   function displayNextResults() {
//     if (totalResults <= 0) {
//       console.log("Tous les résultats ont été affichés."); // Vérifie si tous les résultats ont été affichés
//       return;
//     }

//     let remainingResults = Math.min(5, totalResults); // Calcule le nombre de résultats restants ou 5, le plus petit
//     for (let i = 0; i < remainingResults; i++) {
//       if (currentIndex >= vulnerabilities.length) {
//         console.log("Tous les résultats ont été affichés."); // Vérifie si tous les résultats ont été affichés
//         return;
//       }
//       console.log(vulnerabilities[currentIndex]); // Affiche le résultat
//       currentIndex++;
//       totalResults--;
//     }

//     if (totalResults > 0) {
//       setTimeout(displayNextResults, 6000); // Pause de 6 secondes avant d'afficher le prochain lot
//     } else {
//       console.log("Tous les résultats ont été affichés."); // Affiche un message lorsque tous les résultats sont affichés
//     }
//   }

//   displayNextResults(); // Appelle la fonction pour afficher les résultats
// }

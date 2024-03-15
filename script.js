document.getElementById("resetBtn").addEventListener("click", function () {
  var form = document.getElementById("Form");

  // Réinitialiser les listes déroulantes
  var selects = form.getElementsByTagName("select");
  for (var i = 0; i < selects.length; i++) {
    selects[i].selectedIndex = 0;
  }

  // Effacer les résultats
  var resultElements = document.querySelectorAll(".TotalNote");
  for (var j = 0; j < resultElements.length; j++) {
    resultElements[j].textContent = ""; // Efface le contenu des éléments qui affichent les résultats
  }
});

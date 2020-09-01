(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("mapa")) {
      //Map
      var map = L.map("mapa").setView([-5.643183, -78.522766], 16);

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
          '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      }).addTo(map);

      L.marker([-5.643183, -78.522766])
        .addTo(map)
        .bindPopup("UNTRM - FISME - Bagua <br> Boletos disponibles")
        .openPopup();
      /*.bindTooltip('Un Tooltip')
                .openTooltip()*/
    }
  }); //DOM CONTENT LOADED
})();

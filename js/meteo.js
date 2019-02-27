var meteoContainer = document.getElementById('api');
var ourRequest = new XMLHttpRequest();
ourRequest.open('GET', 'http://api.openweathermap.org/data/2.5/forecast?id=3176219&APPID=851a610fefee2192d57772e978394d8d');
ourRequest.onload = function () {
    
    "use strict";
    var ourData = JSON.parse(ourRequest.responseText);
    renderHTML(ourData.city.name);
    /*ourData stampa tutto quello che l'API ha da darti, se apri la console con f12 vedi come viene strutturato l'output
    io ho selezionato il nome della città e il meteo, se ne hai voglia e vuoi aggiungere altro non ci sono problemi*/
    
    /*console.log(ourData.city.name);*/
   /* console.log(ourData.list[0].weather[0].main);*/
    /*ourData.city.name nome della città*/
    /*ourData.list[0].weather[0].main condizioni climatiche*/
};
ourRequest.send();

function renderHTML(data) {
    "use strict";
    meteoContainer.insertAdjacentHTML('beforeend', data);
}
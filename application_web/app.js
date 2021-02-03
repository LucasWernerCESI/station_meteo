
// Connection API
const meteo = await fetch("API/CHEMIN")
    .then(resultat => resultat.json())
    .then(json => json);

            
// Afficher les informations sur la page
    displayWeatherInfos(meteo)

function displayWeatherInfos (data){

    const id_sonde = data.body[0].id_sonde;
    const date_heure = data.body[0].date_heure;                            
    const temperature = data.body[0].Temperature;
    const humidite = data.body[0].Humidity;
    const emplacement = data.body[0].nom_emplacement;

    document.querySelector('#emplacement').textContent = emplacement;
    document.querySelector('#sonde').textContent = id_sonde;
    document.querySelector('#time').textContent = date_heure;
    document.querySelector('#temperature').textContent = Math.round(temperature);
    document.querySelector('#humidite').textContent = humidite;

}
main();
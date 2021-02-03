
// Connection API
const meteo = await fetch("API/CHEMIN")
    .then(resultat => resultat.json())
    .then(json => json);

            
// Afficher les informations sur la page
    displayWeatherInfos(meteo)

function displayWeatherInfos (data){

    const time = data.StatusSNS.Time;                            
    const temperature = data.StatusSNS.HTU21.Temperature;
    const humidity = data.StatusSNS.HTU21.Humidity;

    document.querySelector('#Time').textContent = Time;
    document.querySelector('#Temperature').textContent = Math.round(temperature);
    document.querySelector('#Humidity').textContent = humidity;

}
main();
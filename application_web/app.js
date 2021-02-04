
var callBackGetSuccess = function(data){
    console.log("données api", data)
    
    var temp = document.getElementById("temperature");
    temp.innerHTML = "La température est de " + data.body[0].temperature;

    var humi = document.getElementById("humidite");
    humi.innerHTML = "Le taux d'humidité est de : " + data.body[0].humidite;

    //var sond = document.getElementById("sonde");
    //sond.innerHTML = "L'id de la sonde  est : " + data.body[0].id_sonde;

    var empl = document.getElementById("nom_emplacement");
    empl.innerHTML = "L'emplacement de la sonde est dans la " + data.body[0].nom_emplacement;

    var time = document.getElementById("date_heure");
    time.innerHTML = "Nous sommes le : " + data.body[0].date_heure;
}


function buttonClickGET(){
    var url = "http://localhost/station_meteo/api/data/read.php"

    $.get(url, callBackGetSuccess).done(function(){
        // alert ("second success")
    })
    .fail(function(){
        alert("error");
    })
    .always(function(){
        // alert ("finished")
    });
}



//************************************************************ */
//function displayWeatherInfos (data){

//    const id_sonde = data.body[0].id_sonde;
//    const date_heure = data.body[0].date_heure;                            
//    const temperature = data.body[0].Temperature;
//    const humidite = data.body[0].Humidity;
//    const emplacement = data.body[0].nom_emplacement;

//    document.querySelector('#emplacement').textContent = emplacement;
//    document.querySelector('#sonde').textContent = id_sonde;
//    document.querySelector('#time').textContent = date_heure;
//    document.querySelector('#temperature').textContent = Math.round(temperature);
//    document.querySelector('#humidite').textContent = humidite;

//}
//main();
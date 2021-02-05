// Graphic
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawAxisTickColors);

function drawAxisTickColors() {
      var data = google.visualization.arrayToDataTable([
        ['emplacement', 'Température', 'Humidité'],
        ['Chambre', 24.70, 32.10],
        ['Salon', 18.52, 17],
        ['Jardin', 30, 12],
        ['Garage', 12, 35],
      ]);

      var options = {
        title: 'Moyenne des dernier relevés météorologique ',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Total de Sonde',
          minValue: 0,
          textStyle: {
            bold: true,
            fontSize: 12,
            color: '#4d4d4d'
          },
          titleTextStyle: {
            bold: true,
            fontSize: 18,
            color: '#4d4d4d'
          }
        },
        vAxis: {
          title: 'Emplacement',
          textStyle: {
            fontSize: 14,
            bold: true,
            color: '#848484'
          },
          titleTextStyle: {
            fontSize: 14,
            bold: true,
            color: '#848484'
          }
        }
      };
      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
// ***************************************************
var callBackGetSuccess = function(data){
    console.log("données api", data)
    
    var temp = document.getElementById("temperature");
    temp.innerHTML = "La température est de " + data.body[0].temperature + "°c";

    var humi = document.getElementById("humidite");
    humi.innerHTML = "Le taux d'humidité est de " + data.body[0].humidite + "%";

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
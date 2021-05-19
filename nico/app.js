 //google.charts.load('current', {packages: ['corechart', 'bar']});
 //google.charts.setOnLoadCallback(drawAxisTickColors);
    
    var callBackGetSuccess = function(data){
      console.log("données api", data)
      
      var temp = document.getElementById("temperature");
      temp.innerHTML = "<i> La température est de  <b>" + data.body[0].temperature + "°c</b></i> ";
  
      var humi = document.getElementById("humidite");
      humi.innerHTML = "<i>Le taux d'humidité est de <b>" + data.body[0].humidite + "% </b></i> ";
  
      //var sond = document.getElementById("sonde");
      //sond.innerHTML = "L'id de la sonde  est : " + data.body[0].id_sonde;
  
      var empl = document.getElementById("nom_emplacement");
      empl.innerHTML = "<h2>" + data.body[0].nom_emplacement + "</h2>";
    }
      function buttonClickGET(){
        var url = "http://localhost/station_meteo_test/api/data/read.php";
    
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

   // test ici button add and delet

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
            chartArea: {width: '40%'},
            
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
    
    // Changement du theme - Change current theme
    // Adapté de - Adapted from : https://wdtz.org/bootswatch-theme-selector.html
    var supports_storage = supports_html5_storage();
    if (supports_storage) {
      var theme = localStorage.theme;
      console.log("Recharge le theme " + theme);
      if (theme) {
        set_theme(get_themeUrl(theme));
      }
    }
    
    // Nouveau theme sélectionne - New theme selected
    jQuery(function($){
      $('body').on('click', '.change-style-menu-item', function() {
        var theme_name = $(this).attr('rel');
        console.log("Change theme " + theme_name);
        var theme_url = get_themeUrl(theme_name);
        console.log("URL theme : " + theme_url);
        set_theme(theme_url);
      });
    });
    // Recupere l'adresse du theme - Get theme URL
    function get_themeUrl(theme_name){
      $('#labelTheme').html("Th&egrave;me : " + theme_name);
      var url_theme = "";
      if ( theme_name === "bootstrap" ) {
        url_theme = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css";
      } else {
        url_theme = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/" + theme_name + "/bootstrap.min.css";
      }
      if (supports_storage) {
        // Enregistre le theme sélectionné en local - save into the local database the selected theme
        localStorage.theme = theme_name;
      }
      return url_theme;
    }
    // Applique le thème - Apply theme
    function set_theme(theme_url) {
      $('link[title="main"]').attr('href', theme_url);
    }
    // Stockage local disponible ? - local storage available ?
    function supports_html5_storage(){
      try {
        return 'localStorage' in window && window['localStorage'] !== null;
      } catch (e) {
        return false;
      }}
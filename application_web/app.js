$(document).ready(() => {

    $("#testAPI").click((event) => {
        testAPI();
    })
    
});

function testAPI(){
    $.get( "../api/data/read.php",
    (data) => {

        let sensors = data.body;

        console.log(sensors[0]);

        $( "#app" ).append(sensors[0].nom_emplacement + ' ');
        $( "#app" ).append(sensors[0].temperature + ' ');
        $( "#app" ).append(sensors[0].humidite + ' ');

    });
}
<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Data.php';

    $db = Database::getConnection();

    $data = new Data($db);

    $sensorData = json_decode(file_get_contents("../../acquisition_donnees/capteur.json"), true);

    //GET sensor ID
    $sensorKeyArr = [];

    foreach($sensorData['StatusSNS'] as $key => $value){
        $sensorKeyArr[] = $key;
    }

    $idSonde = $sensorKeyArr[1];

    $data->temperature = $sensorData['StatusSNS'][$idSonde]["Temperature"];
    $data->humidite = $sensorData['StatusSNS'][$idSonde]["Humidity"];
    $data->id_sonde = $idSonde;
    
    if($data->createData()){
        echo 'Data created successfully.';
    } else{
        echo 'Data could not be created.';
    }
?>
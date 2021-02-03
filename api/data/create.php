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

    $sensorData = json_decode(file_get_contents("php://input"));

    $data->date_heure = $sensorData->date_heure;
    $data->temperature = $sensorData->temperature;
    $data->humidite = $sensorData->humidite;
    $data->id_sonde = $sensorData->id_sonde;
    
    if($item->createData()){
        echo 'Data created successfully.';
    } else{
        echo 'Data could not be created.';
    }
?>
<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Data.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Data($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->date_heure = $data->date_heure;
    $item->temperature = $data->temperature;
    $item->humidite = $data->humidite;
    $item->id_sonde = $data->id_sonde;
    
    if($item->createData()){
        echo 'Data created successfully.';
    } else{
        echo 'Data could not be created.';
    }
?>
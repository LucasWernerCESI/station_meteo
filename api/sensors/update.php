<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if($_SERVER['REQUEST_METHOD'] == 'GET'){

    include_once '../config/database.php';
    include_once '../class/sensor.php';

    $database = new Database();
    $db = $database->getConnection();

    $sensor = new Sensor($db);

    $data = json_decode(file_get_contents("php://input"));

    $sensor->id_sonde = $data->id_sonde;

    $sensor->id_sonde = $data->id_sonde;
    $sensor->id_emplacement = $data->id_emplacement;

    if($sensor->updateSensor()){
        echo json_encode("Sensor is up to date");
    }else{
        echo json_encode("Sensor cannot be updated");
    };
}
?>
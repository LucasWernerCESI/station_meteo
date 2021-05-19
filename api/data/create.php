<?php

include_once(dirname(__DIR__) . '../vendor/autoload.php');

use Classes\Data;
use Classes\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// HTTP verb check
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Get request body
    $requestParams = json_decode(file_get_contents('php://input'), true);

    $data = new Data ( Database::getConnection() );

    $sensorData = json_decode(file_get_contents("../../acquisition_donnees/capteur.json"), true);

    //GET sensor ID
    $sensorKeyArr = [];

    foreach ($sensorData['StatusSNS'] as $key => $value) {
        $sensorKeyArr[] = $key;
    }

    $idSonde = $sensorKeyArr[1];

    $data->temperature = $sensorData['StatusSNS'][$idSonde]["Temperature"];
    $data->humidite = $sensorData['StatusSNS'][$idSonde]["Humidity"];
    $data->id_sonde = $idSonde;

    if ( $data->createData() ) {
        http_response_code(200);
        echo json_encode(['message' => 'Data created successfully.']);
    } else {
        http_response_code(403);
        echo json_encode(['message' => 'Data could not be created.']);
    }

} else {
    // Error handling
    http_response_code(405);
    echo json_encode(["message" => "Unauthorized method"]);
}

// HTTP verb check
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Get request body
    $requestParams = json_decode(file_get_contents('php://input'), true);
    if (isset($requestParams['sensorId']) && isset($requestParams['temperature']) && isset($requestParams['humidity'])) {
        $data = ( new Data () )
            ->setSensorId($requestParams['sensorId'])
            ->setTemperature($requestParams['temperature'])
            ->setHumidity($requestParams['humidity']);
        if ( Data::createData ( $data, Database::getConnection() ) ) {
            http_response_code(200);
            echo json_encode(['message' => 'Data created successfully.']);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Data could not be created.']);
        };
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Could not create Data without data.']);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Unauthorized method."]);
}
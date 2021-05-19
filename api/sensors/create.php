<?php

include_once(dirname(__DIR__) . '../vendor/autoload.php');

use Classes\Sensor;
use Classes\Database;

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// HTTP verb check
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $sensor = new Sensor(Database::getConnection());

    $data = json_decode(file_get_contents("php://input"));
    
    if(!empty($data->id_sonde) && !empty($data->id_emplacement)){
        // Ici on a reçu les données
        // On hydrate notre objet
        $sensor->id_sonde = $data->id_sonde;
        $sensor->id_emplacement = $data->id_emplacement;

        if ($sensor->createSensor()) {
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        } else {
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);         
        }
    }
} else {
    // Error handling
    http_response_code(405);
    echo json_encode(["message" => "Unauthorized method"]);
}

?>
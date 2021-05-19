<?php

include_once(dirname(__DIR__) . '../vendor/autoload.php');

use Classes\Data;
use Classes\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// HTTP verb check
if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $stmt = Data::getData(Database::getConnection());

    if ($dataCount > 0) {

        $dataArr = [];
        $dataArr["body"] = [];
        $dataArr["dataCount"] = $stmt->rowCount();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $e = [
                "id_sonde" => $id_sonde,
                "nom_emplacement" => $nom_emplacement,
                "date_heure" => $date_heure,
                "temperature" => $temperature,
                "humidite" => $humidite,
            ];

            $dataArr["body"][] = $e;
        }
        http_response_code(200);
        echo json_encode($dataArr);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "No record found."]);
    }
} else {
    // Error handling
    http_response_code(405);
    echo json_encode(["message" => "Unauthorized method"]);
}
<?php

include_once(dirname(__DIR__) . '../vendor/autoload.php');

use Classes\Place;
use Classes\Database;

header("Access-Control-Allow-Origin: localhost");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// HTTP verb check
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Get request body
    $requestParams = json_decode(file_get_contents('php://input'), true);
    if (isset($requestParams['placeName'])) {
        $place = new Place ( strtolower($requestParams['placeName'] ) );
        if ( Place::createPlace ( $place, Database::getConnection() ) ) {
            http_response_code(200);
            echo json_encode(['message' => 'Place created successfully.']);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Place could not be created.']);
        };
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Could not create place without name.']);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Unauthorized method."]);
}
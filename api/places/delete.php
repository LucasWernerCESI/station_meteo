<?php

include_once(dirname(__DIR__) . '../vendor/autoload.php');

use Classes\Place;
use Classes\Database;

header("Access-Control-Allow-Origin: localhost");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// HTTP verb check
if($_SERVER['REQUEST_METHOD'] === "DELETE"){
    // Get request body
    $requestParams = json_decode(file_get_contents('php://input'), true);
    if ( isset($requestParams['placeName']) && isset($requestParams['placeId']) ) {
        $place = ( new Place ( strtolower($requestParams['placeName'] ) ) )->setId($requestParams['placeId']);
        if ( Place::deletePlace ( $place, Database::getConnection() ) ) {
            http_response_code(200);
            echo json_encode(['message' => 'Place deleted successfully.']);
        } else {
            http_response_code(403);
            echo json_encode(['message' => 'Place could not be deleted.']);
        };
    } else {
        http_response_code(403);
        echo json_encode(['message' => 'Place could not be found.']);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Unauthorized method."]);
}
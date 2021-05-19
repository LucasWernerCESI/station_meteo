<?php

include_once(dirname(__DIR__) . '../vendor/autoload.php');

use Classes\Database;
use Classes\Data;

header("Access-Control-Allow-Origin: localhost");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// HTTP verb check
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if ( $places = Place::listPlaces ( Database::getConnection () ) ) {
        $response = [];
        foreach( $places as $place ){
            $response[] = [
                "placeId" => $place->getId(),
                "placeName" => $place->getName(),
                "sensorId" => $place->getSensorId()
            ];
        };
        http_response_code(200);
        print( json_encode( $response ) );
    } else {
        http_response_code(404);
        print json_encode( ['message' => 'No record found.'] );
    };
} else {
    http_response_code(405);
    print json_encode( ["message" => "Unauthorized method."] );
}
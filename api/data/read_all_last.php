<?php

include_once(dirname(__DIR__) . '../vendor/autoload.php');

use Classes\Database;
use Classes\Data;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// HTTP verb check
if($_SERVER['REQUEST_METHOD'] == 'GET'){

} else {
    // Error handling
    http_response_code(405);
    echo json_encode(["message" => "Unauthorized method"]);
}
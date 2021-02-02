<?php

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");

include_once "../../class/place.php";
include_once "../../config/database.php";

$database = new Database();
$db = $database->getConnection();

$place = new Place($db);

?>
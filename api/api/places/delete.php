<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once "../../class/place.php";
    include_once "../../config/database.php";
    
    $database = new Database();
    $db = $database->getConnection();
    
    $place = new Place($db);
    
    $placeName = (isset($_GET['nom_emplacement'])) ? $_GET['nom_emplacement'] : '';
    
    $place->place_name = $placeName;
    
    if($place->deletePlace()){
        echo json_encode("Place deleted.");
    } else{
        echo json_encode("Place could not be deleted");
    }
?>
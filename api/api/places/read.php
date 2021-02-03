<?php

    header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");

    include_once "../../class/place.php";
    include_once "../../config/database.php";

    $database = new Database();
    $db = $database->getConnection();

    $place = new Place($db);

    $placeName = (isset($_GET['nom_emplacement'])) ? $_GET['nom_emplacement'] : '';

    $stmt = $place->getPlaces();

    $placeCount = $stmt->rowCount();

    echo json_encode($placeCount);

    if($placeCount > 0){
            
        $placesArr = array();
        $placesArr["body"] = array();
        $placesArr["itemCount"] = $placeCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "nom_emplacement" => $nom_emplacement
            );

            array_push($placesArr["body"], $e);
        }
        
        echo json_encode($placesArr);
        
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    };

?>
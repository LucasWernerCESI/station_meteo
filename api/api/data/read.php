<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/Data.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Data($db);

    $stmt = $items->getData();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $DataArr = array();
        $DataArr["body"] = array();
        $DataArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_releve_meteo" => $id_releve_meteo,
                "date_heure" => $date_heure,
                "temperature" => $temperature,
                "humidite" => $humidite,
                "id_sonde" => $id_sonde
            );

            array_push($DataArr["body"], $e);
        }
        echo json_encode($DataArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
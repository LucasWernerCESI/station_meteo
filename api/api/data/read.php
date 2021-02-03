<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/data.php';

    $db = Database::getConnection();

    $stmt = Data::getData();
    $dataCount = $stmt->rowCount();


    echo json_encode($dataCount);

    if($dataCount > 0){
        
        $dataArr = array();
        $dataArr["body"] = array();
        $dataArr["dataCount"] = $dataCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_sonde" => $id_sonde,
                "nom_emplacement" => $nom_emplacement,
                "date_heure" => $date_heure,
                "temperature" => $temperature,
                "humidite" => $humidite
                
            );

            array_push($dataArr["body"], $e);
        }
        http_response_code(200);
        echo json_encode($dataArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
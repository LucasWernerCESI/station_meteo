<?php

use Classes\Sensor;
use Classes\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les sensors
    $sensor = new Sensor($db);

    // On récupère les données
    $stmt = $sensor->getSensor();

    // On vérifie si on a au moins 1 sensor
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauCapteurs = [];
        $tableauCapteurs['sensors'] = [];

        // On parcourt les sensors
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $capteur = [
                "id_sonde" => $id_sonde,
                "id_emplacement" => $id_emplacement
  
            ];

            $tableauCapteurs['sensors'][] = $capteur;
        }

        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauCapteurs);
    }

}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
?>
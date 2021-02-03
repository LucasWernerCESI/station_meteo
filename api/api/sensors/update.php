<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/sensor.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les sensors
    $sensor = new Sensor($db);

$data = json_decode(file_get_contents("php://input"));

$sensor -> id_sondes = $data ->id_sondes;

$sensor->id_sondes = $data ->id_sondes;
$sensor->id_emplacement = $data ->id_emplacement;

if($sensor->updateSensor()){
    echo json_encode("sensor mis à jour");
}else{
    echo json_encode("sensor non mis à jour");
}

?>
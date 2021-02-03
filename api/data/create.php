<?php

    // headers requis
    header("Acces-Control-Allow-Origin : *"); // Autorise ou non l'accès à l'API en fonction de l'origine de l'utilisateur
    header("Content-type: application/json; charset=UTF-8"); // les données sont retranscrites en langage json contenu de la réponse réponds 
    //à la norme rest consultable avec n'importe quel type de données.
    header("Access-control-Allow-Methods: POST"); // Sélectionne la méthode autorisée
      
    if ($_server['REQUEST_METHOD'] == 'POST')//vérifie si la méthode 
        //on inclut les fichiers de configurations et données
        include_once '../api/config/database.php';
        include_once '../api/class/sensors.php/';
    
        //on instancie la base de données
        $databe = new database();
        $db = $databe->getconnection();

        //on instancie les données sensor
        $sensor = new Sensor($db);

        //on récupère les informations renvoyées
        $donnees = json_decode(file_get_contents("php://input"));

        if(!empty($donnees->name) && !empty($donnees->email) && !empty($donnees->age) && !empty($donnees->designation)){
           
            // Ici on a reçu les données et on renseigne notre objet
           
            $sensor->name = $donnees->name;
            $produit->email = $donnees->email;
            $produit->age = $donnees->age;
            $produit->designation = $donnees->designation;
    
            if($produit->creer()){

                //la création a fonctionné
                http_response_code(201);
                echo json_encode(["message" => "L'ajout a été effectué"]);
            }else{
                //la création n'a pas fonctionné
                http_response_code(503);
                echo json_encode(["message" => "L'ajout n'a pas été effectué"]);
    }else{
    http_response_code(405);
    echo json_encode(["message" ==> "La méthode utilisée n'est pas autorisée"])
    }



?>
<?php
//Test merge
//Voir si les fichiers s'écrasent
?>
<?php
    //récupèration de la connexion
    require 'connexion.php';

    //Requête de création de la table blog

    $db->exec("CREATE TABLE `users` (
         id INT(10) unsigned not null AUTO_INCREMENT PRIMARY KEY,
        `date` datetime NOT NULL,
        `nom` varchar(40) NOT NULL,
        `prenom` varchar(40) NOT NULL,
        `login` varchar(40) NOT NULL,
        `pass` varchar(40) NOT NULL
      ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET = utf8mb4");

    echo 'La table users a été créée.';

?>
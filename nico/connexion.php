<?php
    
    //Stocke les infos de la bdd dans des variables :
    $host = 'localhost'; //dans variable $dsn
    $db = 'meteo'; //dans variable $dsn
    $user = 'root';
    $pass = '';
    $port = ''; // A modifier, dans variable $dsn
    $charset = 'utf8mb4'; //dans variable $dsn
    $dsn = "mysql:host=$host; port=$port; dbname=$db; charset=$charset";

    //informations en cas d'erreur stockée dans un tableau
    $options = [
        \PDO::ATTR_ERRMODE              => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE   => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES    => false,
    ];

    //Tentative de connexion
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        echo 'Connexion à la base de données réussie !!';
   } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
   }

?>
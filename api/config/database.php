<?php 
    class Database {

        /**
         * Nom du sgbd utilisé
         * @var string $sgbd
         */
        private $sgbd = "mysql";

        /**
         * Nom/adresse de l'hôte
         * @var string $host
         */
        private $host = "127.0.0.1";

        /**
         * Nom de la base de données à laquelle se connecter
         * @var string $database_name
         */
        private $database_name = "station_meteo";

        /**
         * Port à adresser pour tomber sur le bon moteur
         * @var string $port
         */
        private $port = "3307";

        /**
         * Nom d'utilisateur
         * @var string $username
         */
        private $username = "root";

        /**
         * MDP utilisateur
         * @var string $password
         */
        private $password = "";

        /**
         * Objet PDO
         * @var object $connection
         */
        public $connection;

        /**
         * Configuration de la connexion SQL (PDO)
         * @return object PDO
         */
        public function getConnection(){

            $this->connection = null;
            
            //Tente de créer un objet PDO
            try{
                $this->connection = new PDO($this->sgbd . ":host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->connection->exec("set names utf8");
            }

            //Si la connexion ne fonctionne pas balance une exception
            catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }

            //Retourne l'ojet PDO
            return $this->connection;
        }
    }  
?>
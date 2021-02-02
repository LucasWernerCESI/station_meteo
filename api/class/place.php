<?php
    class Place{

        // Connection
        private $connection;

        // Tables
        private $db_table = "emplacements";

        // Columns
        public $nom_emplacement;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // GET ALL
        public function getPlaces(){
            $sqlQuery = "SELECT nom_emplacement FROM " . $this->db_table;
            $stmt = $this->connection->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createPlace(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        nom_emplacement = :nom_emplacement";
        
            $stmt = $this->connection->prepare($sqlQuery);
        
            // sanitize
            $this->nom_emplacement=htmlspecialchars(strip_tags($this->nom_emplacement));
        
            // bind data
            $stmt->bindParam(":nom_emplacement", $this->nom_emplacement);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deletePlace(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE nom_emplacement = :nom_emplacement";
            $stmt = $this->connection->prepare($sqlQuery);
        
            $this->nom_emplacement = htmlspecialchars(strip_tags($this->nom_emplacement));
        
            $stmt->bindParam(":nom_emplacement", $this->nom_emplacement);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
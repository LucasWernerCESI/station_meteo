<?php
    class Place{

        // Connection
        private $connection;

        // Tables
        private $db_table = "emplacements";

        // Columns
        public $place_name;

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
            $this->place_name = htmlspecialchars(strip_tags($this->place_name));
        
            // bind data
            $stmt->bindParam(":nom_emplacement", $this->place_name);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deletePlace(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE nom_emplacement = :nom_emplacement";
            $stmt = $this->connection->prepare($sqlQuery);
        
            $this->place_name = htmlspecialchars(strip_tags($this->place_name));
        
            $stmt->bindParam(":nom_emplacement", $this->place_name);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
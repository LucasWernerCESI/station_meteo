<?php
    class Sensor{
        private $conn;

        private $db_table = "sonde";
        private $db_table_join = "emplacement"

        public $id_sonde
        public $id_emplacement
        public $nom_emplacement
        
        public_function __construct($db){
            $this->conn = $db;
        }
        //GET ALL
        public function getSensor(){
            $sqlQuery = "SELECT id_sonde, nom_emplacement FROM " . $this->db_table . " JOIN " . $this->db_table_join;
            $stmt = $this->connection->prepare($sqlQuery);
            $stmt->execute();
            return $stmt; 
        }
        //CREATE
        public fonction createSensor(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_sonde = :id_sonde, 
                        id_emplacement = :id_emplacement" 
                        
        
            $stmt = $this->connection->prepare($sqlQuery);
        
            // sanitize
            $this->id_sonde=htmlspecialchars(strip_tags($this->id_sonde));
            $this->id_emplacement=htmlspecialchars(strip_tags($this->id_emplacement));

        
            // bind data
            $stmt->bindParam(":id_sonde", $this->id_sonde);
            $stmt->bindParam(":id_emplacement", $this->id_emplacement);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleSensor(){
            $sqlQuery = "SELECT
                        id_sonde,  
                        id_emplacement, 
                     
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id_sonde = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_sonde);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id_sonde = $dataRow['id_sonde'];
            $this->id_emplacement = $dataRow['id_emplacement'];
        }        

        // UPDATE
        public function updateSensor(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id_sonde = :id_sonde, 
                        id_emplacement = :id_emplacement, 

                    WHERE 
                        id_sonde = :id_sonde";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_sonde=htmlspecialchars(strip_tags($this->id_sonde));
            $this->id_emplacement=htmlspecialchars(strip_tags($this->id_emplacement));
 
        
            // bind data
            $stmt->bindParam(":id_sonde", $this->id_sonde);
            $stmt->bindParam(":id_emplacement", $this->id_emplacement);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteSensor(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_sonde = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_sonde=htmlspecialchars(strip_tags($this->id_sonde));
        
            $stmt->bindParam(1, $this->id_sonde);
        
            if($stmt->execute()){
                return true;
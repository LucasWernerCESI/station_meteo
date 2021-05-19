<?php

use Classes\Database;

    class User{

        // Connection
        private $connection;

        // Table
        private $db_table = "User";

        // Columns
        private $id;
        private $name;
        private $email;
        private $creationDate;
        private $hashedPassword;

        // Db connection
        public function __construct( Database $connection, string $name, string $email, string $creationDate, string $hashedPassword ) {
            $this->connection = $connection;
            $this->name = $name;
            $this->email = $email;
            $this->creationDate = new DateTime( $creationDate );
            $this->hashedPassword = $hashedPassword;
        }

        // GET ALL
        public static function listUsers(){
            $sqlQuery = "SELECT * FROM " . self::$db_table;
            $stmt = self::$connection->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public static function createUser( User $user ) {
            $sqlQuery = "INSERT INTO
                        ". self::$db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        creation_date = :creation_date";
        
            $stmt = self::$connection->prepare($sqlQuery);
        
            // sanitize
            $user->name=htmlspecialchars(strip_tags($this->name));
            $user->email=htmlspecialchars(strip_tags($this->email));
            $user->creationDate=htmlspecialchars(strip_tags($this->creation_date));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":creation_date", $this->creation_date);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public static function getUser(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        email, 
                        creation_date
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->creation_date = $dataRow['creation_date'];
        }        

        // UPDATE
        public static function updateUser(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        creation_date = :creation_date
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->creation_date=htmlspecialchars(strip_tags($this->creation_date));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":creation_date", $this->creation_date);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        public static function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
<?php 

class Data
{ 

// Connection 
    private $connection; 

// Table 
    private $db_table = "donnees_meteo"; 

// Columns 
    public $id_releve_meteo; 
    public $date_heure; 
    public $temperature; 
    public $humidite; 
    public $id_sonde;  

// Db connection 
    public function __construct($db)
    { 
        $this->connection = $db;
    } 


// GET ALL 
    public static function getData($db)
    {
        $sqlQuery = "
        SELECT " . self::db_table_sensors . " date_heure, nom_emplacement, temperature, humidite, id_sonde FROM " . self::db_table_data;"
        JOIN " . self::db_table_sensors . "
            ON " . self::db_table_data . "id_sonde - " . self::db_table_sensors . " id_sonde
        JOIN " . self::db_table_places . "
            ON " . self::db_table_sensors . " .id_emplacement = " . self::db_table_places . ".id_emplacement";

        $stmt = $db->prepare($sqlQuery);
        $stmt->execute(); 
        return $stmt;
    } 
// CREATE 
    public function createData()
    { 
        $sqlQuery = "INSERT INTO "
                    . $this->db_table
                    ." SET 
                    id_releve_meteo = :id_releve_meteo,
                    date_heure = :date_heure, 
                    temperature = :temperature, 
                    humidite = :humidite, 
                    id_sonde = :id_sonde";
        $stmt = $this->connection->prepare($sqlQuery); 
    
        // sanitize 
        $this->id_releve_meteo=htmlspecialchars(strip_tags($this->id_releve_meteo)); 
        $this->date_heure=htmlspecialchars(strip_tags($this->date_heure)); 
        $this->temperature=htmlspecialchars(strip_tags($this->temperature)); 
        $this->humidite=htmlspecialchars(strip_tags($this->humidite)); 
        $this->id_sonde=htmlspecialchars(strip_tags($this->id_sonde)); 
        
        // bind data 
        $stmt->bindParam(":id_releve_meteo", $this->id_releve_meteo); 
        $stmt->bindParam(":date_heure", $this->date_heure); 
        $stmt->bindParam(":temperature", $this->temperature); 
        $stmt->bindParam(":humidite", $this->humidite); 
        $stmt->bindParam(":id_sonde", $this->id_sonde);

        if($stmt->execute()){
             return true; 
             }
             return false;
    }
// READ sensor's last data 
    public function getLastData($db, $id_sonde)
    { 
        $sqlQuery = "SELECT date_heure, temperature, humidite, id_sonde FROM ". $selff::db_table ." WHERE id_sonde - :id_sonde ORDER BY date_heure DESC LIMIT 0,1"; 
        $stmt = $this->connection->prepare($sqlQuery); 
        $stmt->bindParam(":id_sonde", $id_sonde); 
        $stmt->execute();

        return $stmt; 
    } 

// READ sensor's Last All Data 
    public function getAllLastData()
    { 
        $sqlQuery = "SELECT date_heure, temperature, humidite, id_sonde FROM ". $selff::db_table ." WHERE id_sonde - :id_sonde ORDER BY date_heure DESC LIMIT 0,1"; 
        $stmt = $db->prepare($sqlQuery); 
        $stmt->bindParam(":id_sonde", $id_sonde); 
        $stmt->execute();
    
        $stmt_data = [];
        foreach($stmt as $id_sonde){
            array_push($stmt_data = self::getLastData($db, $id_sonde));
            // $stmt_data[] = self::getLastData($db, $id_sonde);
        }
    } 
}
                
?>
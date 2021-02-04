<?php 

class Data { 

    // Connection 
    private $connection; 

    // Tables 
    const DB_TABLE_DATA = "donnees_meteo";
    const DB_TABLE_SENSORS = "sondes";
    const DB_TABLE_PLACES = "emplacements";

    // Columns 
    public $nom_emplacement; 
    public $date_heure; 
    public $temperature; 
    public $humidite; 
    public $id_sonde;

    // Db connection 
    public function __construct($db)
    { 
        $this->connection = $db;
    } 

    /**
     * GET data w/ param 
     * @param object $db (PDO)
     * @param string $id_sonde
     * @param array $timePeriod (start date_time, end date_time)
     * @return object $stmt (SQL statement)
     */
    public static function getData($db, $id_sonde = '', $timePeriod = [])
    {
        $sqlQuery = "
        SELECT " . self::DB_TABLE_SENSORS . ".id_sonde, nom_emplacement, date_heure, temperature, humidite FROM " . self::DB_TABLE_DATA . " 
            JOIN " . self::DB_TABLE_SENSORS . " 
                ON " . self::DB_TABLE_DATA . ".id_sonde = " . self::DB_TABLE_SENSORS . ".id_sonde
            JOIN " . self::DB_TABLE_PLACES . "
                ON " . self::DB_TABLE_SENSORS . ".id_emplacement = " . self::DB_TABLE_PLACES . ".id_emplacement";

        $stmt = $db->prepare($sqlQuery);
        
        $stmt->execute(); 
        return $stmt;
    } 

    // CREATE 
    public function createData()
    { 
        $sqlQuery = "
        INSERT INTO " . self::DB_TABLE_DATA . " 
            SET date_heure = :date_heure, 
                temperature = :temperature, 
                humidite = :humidite, 
                id_sonde = :id_sonde";
                
        $stmt = $this->connection->prepare($sqlQuery); 
    
        // sanitize 
        $this->date_heure = htmlspecialchars(strip_tags($this->date_heure)); 
        $this->temperature = htmlspecialchars(strip_tags($this->temperature)); 
        $this->humidite = htmlspecialchars(strip_tags($this->humidite)); 
        $this->id_sonde = htmlspecialchars(strip_tags($this->id_sonde)); 
        
        // bind data 
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
    public static function getLastData($db, $id_sonde)
    { 
        $sqlQuery = "SELECT date_heure, temperature, humidite, id_sonde FROM ". self::DB_TABLE_DATA ." WHERE id_sonde = :id_sonde ORDER BY date_heure DESC LIMIT 0,1"; 
        $stmt = $db->prepare($sqlQuery); 
        $stmt->bindParam(":id_sonde", $id_sonde);
        $stmt->execute();

        return $stmt; 
    } 

    // READ all sensors' last data
    public static function getAllLastData($db){
        $sqlQuery = "SELECT id_sonde FROM ". self::DB_TABLE_SENSORS; 
        $stmt = $db->prepare($sqlQuery); 
        $stmt->execute();

        $stmt_data = [];

        foreach($stmt as $id_sonde){
            $stmt_data[] = self::getLastData($db, $id_sonde);
        }

        return $stmt_data;
    }
}
                
?>
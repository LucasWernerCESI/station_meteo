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
    public function getData()
    {
        $sqlQuery = "SELECT id_releve_meteo, date_heure, temperature, humidite, id_sonde FROM " . $this->db_table;
        $stmt = $this->connection->prepare($sqlQuery);
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
// READ single 
    public function getSingleData()
    { 
        $sqlQuery = "SELECT id_releve_meteo, date_heure, temperature, humidite, id_sonde FROM ". $this->db_table ." WHERE id = ? LIMIT 0,1"; 
        $stmt = $this->connection->prepare($sqlQuery); 
        $stmt->bindParam(1, $this->id); 
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
         $this->id_releve_meteo = $dataRow['id_releve_meteo']; 
         $this->date_heure = $dataRow['date_heure']; 
         $this->temperature = $dataRow['temperature']; 
         $this->humidite = $dataRow['humidite']; 
         $this->id_sonde = $dataRow['id_sonde']; 
    } 
}
                
?>
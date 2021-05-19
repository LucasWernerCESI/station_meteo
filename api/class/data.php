<?php 

namespace Classes;

use DateTime;

class Data { 

    // Tables 
    const DB_TABLE_DATA = "donnees_meteo";
    const DB_TABLE_SENSORS = "sondes";
    const DB_TABLE_PLACES = "emplacements";

    // Columns 
    private $dateTime; 
    private $temperature; 
    private $humidity; 
    private $sensorId;
    private $placeId;

    // Db connection 
    public function __construct() {

    } 

    /**
     * GET data w/ param 
     * @param  Database $db (PDO)
     * @param  string $id_sonde
     * @param  array $timePeriod (start date_time, end date_time)
     * @return array[Data] $results (SQL statement)
     */
    public static function getData( Database $db, string $id_sonde, array $timePeriod = ["last week", "today"] ) : array {

        $startDate = new DateTime($timePeriod[0]);
        $endDate = new DateTime($timePeriod[1]);

        $sqlQuery = "
        SELECT " . self::DB_TABLE_SENSORS . ".id_sonde, nom_emplacement, date_heure, temperature, humidite FROM " . self::DB_TABLE_DATA . " 
            JOIN " . self::DB_TABLE_SENSORS . " 
                ON " . self::DB_TABLE_DATA . ".id_sonde = " . self::DB_TABLE_SENSORS . ".id_sonde
            JOIN " . self::DB_TABLE_PLACES . "
                ON " . self::DB_TABLE_SENSORS . ".id_emplacement = " . self::DB_TABLE_PLACES . ".id_emplacement
            WHERE date_heure BETWEEN " . $startDate->format("%Y/%m/%d 00:00:00") . " AND " . $endDate->format("%Y/%m/%d 23:59:59")
                . ( $id_sonde !== '') ? " AND " . self::DB_TABLE_DATA . ".id_sonde = " . $id_sonde : '';

        $stmt = $db->prepare($sqlQuery);
        
        $results = [];
        while ( $row = $stmt->execute() ) {
            $results[] = $row;
        } 
        return $results;

    } 

    // CREATE 
    public static function createData( Data $data, Database $connection ) : bool { 
        $sqlQuery = "
        INSERT INTO " . self::DB_TABLE_DATA . " 
            SET temperature = :temperature, 
                humidite = :humidite, 
                id_sonde = :id_sonde";
                
        $stmt = $connection->prepare($sqlQuery); 
    
        // sanitize 
        $data->setTemperature(htmlspecialchars(strip_tags($data->getTemperature()))); 
        $data->setHumidity(htmlspecialchars(strip_tags($data->getHumidity()))); 
        $data->setSensorId(htmlspecialchars(strip_tags($data->getSensorId()))); 
        
        // bind data 
        $stmt->bindParam(":temperature", $data->getTemperature()); 
        $stmt->bindParam(":humidite", $data->getHumidity()); 
        $stmt->bindParam(":id_sonde", $data->getSensorId());

        if($stmt->execute()){
            return true; 
        }
        return false;
    }

    // READ sensor's last data 
    public static function getLastData( Database $db, string $id_sonde ) : array { 
        $sqlQuery = "SELECT date_heure, temperature, humidite, id_sonde FROM ". self::DB_TABLE_DATA ." WHERE id_sonde = :id_sonde ORDER BY date_heure DESC LIMIT 0,1"; 
        $stmt = $db->prepare($sqlQuery); 
        $stmt->bindParam(":id_sonde", htmlspecialchars(strip_tags($id_sonde)));
        
        $results = [];

        while( $row = $stmt->execute() ) {
            $results[] = new Data();
        };

        return $results; 
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

    /**
     * Get the value of dateTime
     */ 
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set the value of dateTime
     *
     * @return  self
     */ 
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get the value of temperature
     */ 
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Set the value of temperature
     *
     * @return  self
     */ 
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get the value of humidity
     */ 
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * Set the value of humidity
     *
     * @return  self
     */ 
    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;

        return $this;
    }

    /**
     * Get the value of sensorId
     */ 
    public function getSensorId()
    {
        return $this->sensorId;
    }

    /**
     * Set the value of sensorId
     *
     * @return  self
     */ 
    public function setSensorId($sensorId)
    {
        $this->sensorId = $sensorId;

        return $this;
    }

    /**
     * Get the value of placeId
     */ 
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * Set the value of placeId
     *
     * @return  self
     */ 
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;

        return $this;
    }
}
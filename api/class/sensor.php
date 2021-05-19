<?php

namespace Classes;

use PDO;
use Classes\Database;

class Sensor {

    /**
     * Sensors table name
     * @var string
     */
    const DB_TABLE_SENSORS = "sonde";

    /**
     * Places table name
     * @var string
     */
    const DB_TABLE_PLACES = "emplacement";

    /**
     * Sensor id
     * @var string|null
     */
    private $id = null;

    /**
     * Place id
     * @var int|null
     */
    private $placeId = null;

    function __construct ( string $id ) {
        $this->id = $id;
    }

    //GET ALL
    public static function listSensors( Database $connection ) : array {
        $query = "
            SELECT id_sonde, nom_emplacement FROM " . self::DB_TABLE_SENSORS . " 
                JOIN " . self::DB_TABLE_PLACES;

        $stmt = $connection->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0){

            $result = [];
    
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $result[] = ( new Sensor ( $id_sonde ) )
                    ->setPlaceId( $id_emplacement )
                    ->setPlaceName( $nom_emplacement );
            };
        }

        return $result;
    }

    //CREATE
    public static function createSensor ( Database $connection ) : bool {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        id_sonde = :id_sonde, 
                        id_emplacement = :id_emplacement";


        $stmt = $this->connection->prepare($sqlQuery);

        // sanitize
        $this->id_sonde = htmlspecialchars(strip_tags($this->id_sonde));
        $this->id_emplacement = htmlspecialchars(strip_tags($this->id_emplacement));


        // bind data
        $stmt->bindParam(":id_sonde", $this->id_sonde);
        $stmt->bindParam(":id_emplacement", $this->id_emplacement);

        return $stmt->execute();
    }

    // UPDATE
    public static function updateSensor ( Database $connection ) : bool {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        id_sonde = :id_sonde, 
                        id_emplacement = :id_emplacement, 

                    WHERE 
                        id_sonde = :id_sonde";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_sonde = htmlspecialchars(strip_tags($this->id_sonde));
        $this->id_emplacement = htmlspecialchars(strip_tags($this->id_emplacement));


        // bind data
        $stmt->bindParam(":id_sonde", $this->id_sonde);
        $stmt->bindParam(":id_emplacement", $this->id_emplacement);

        return $stmt->execute();
    }

    // DELETE
    public static function deleteSensor ( Database $connection ) : bool {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_sonde = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_sonde = htmlspecialchars(strip_tags($this->id_sonde));

        $stmt->bindParam(1, $this->id_sonde);

        return $stmt->execute();
    }

    /**
     * Get sensor id
     * @return string|null
     */ 
    public function getId () : ?string {
        return $this->id;
    }

    /**
     * Set sensor id
     * @param string|null
     * @return Sensor
     */ 
    public function setId ( string $id ) : Sensor {
        $this->id = strtoupper( $id );
        return $this;
    }

    /**
     * Get place id
     *
     * @return  int|null
     */ 
    public function getPlaceId () : ?int
    {
        return $this->placeId;
    }

    /**
     * Set place id
     * @param int
     * @return Sensor
     */ 
    public function setPlaceId ( int $placeId ) : Sensor {
        $this->placeId = $placeId;
        return $this;
    }

    /**
     * Get place name
     * @return string
     */ 
    public function getPlaceName () : ?string {
        return $this->placeName;
    }

    /**
     * Set place name
     * @param string
     * @return Sensor
     */ 
    public function setPlaceName ( string $placeName ) : Sensor {
        $this->placeName = $placeName;
        return $this;
    }
}

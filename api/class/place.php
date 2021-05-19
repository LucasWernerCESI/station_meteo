<?php

namespace Classes;

/**
 * Classe Place
 * Une instance de cette classe représente une pièce de la maison de l'utilisateur
 * @author Lucas Werner <lucas@werner.wtf>
 * @since 2021
 */
class Place {

    /**
     * Table name
     * @var string
     */
    private const DB_TABLE = "emplacements";

    /**
     * Table name
     * @var string
     */
    private const DB_TABLE_SENSORS = "sondes";

    // Columns

    /**
     * Place ID
     * @var int|null
     */
    private $id = null;

    /**
     * Sensor ID
     * @var string
     */
    private $sensorId;

    /**
     * OPlace name
     * @var string
     */
    private $name;

    /**
     * Place constructor
     * @param string 
     */
    public function __construct( string $name ) {
        $this->name = ucfirst( mb_strtolower( $name ) );
    }

    /**
     * Get the value of id
     * @return int
     */ 
    public function getId() : ?int {
        return $this->id;
    }

    /**
     * Set the value of id
     * @return Place
     */ 
    public function setId( int $id ) : Place {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of id
     * @return string
     */ 
    public function getSensorId() : string {
        return $this->sensorId;
    }

    /**
     * Set the value of id
     * @return Place
     */ 
    public function setSensorId( string $sensorId ) : Place {
        $this->sensorId = $sensorId;
        return $this;
    }

    /**
     * Get the value of name
     * @return int
     */ 
    public function getName() : string {
        return $this->name;
    }

    /**
     * Set the value of name
     * @return Place
     */ 
    public function setName( string $name ) : Place {
        $this->name = ucfirst ( mb_strtolower ( $name ) );
        return $this;
    }

    /**
     * Lists every place in the house
     * @param Database
     * @return array|bool
     */
    public static function listPlaces( Database $connection ) : ?array {

        $query = "SELECT " . self::DB_TABLE . ".*, " . self::DB_TABLE_SENSORS . ".id_sonde FROM " . self::DB_TABLE 
            . " LEFT JOIN " . self::DB_TABLE_SENSORS . " ON " . self::DB_TABLE . ".id_emplacement = " . self::DB_TABLE_SENSORS . ".id_emplacement";

        $stmt = $connection->prepare( $query );
        $stmt->execute();

        if ( $stmt->rowCount() > 0 ) {
            $result = [];
            while ( $row = $stmt->fetch( Database::FETCH_ASSOC ) ) {
                $result[] = ( new Place( $row['nom_emplacement'] ) )
                    ->setId( $row['id_emplacement'] )
                    ->setSensorId( ( $row['id_sonde'] ) ? $row['id_sonde'] : '' );
            };
            return $result;
        }
        return false;
    }

    /**
     * Create new place
     * @param  Place
     * @param  Database
     * @return bool 
     */
    public static function createPlace( Place $place, Database $connection ) : bool {
        $query = "INSERT INTO
                        " . self::DB_TABLE . "
                    SET
                        nom_emplacement = :nom_emplacement";

        $stmt = $connection->prepare($query);

        // sanitize
        $place->setName( htmlspecialchars( strip_tags( $place->getName() ) ) );

        // bind data
        $stmt->bindParam( ":nom_emplacement", $place->getName() );

        return $stmt->execute();
    }

    /**
     * Delete place
     * @param  Place
     * @param  Database
     * @return bool
     */
    public static function deletePlace( Place $place, Database $connection ) : bool {
        $query = "DELETE FROM " . self::DB_TABLE . " WHERE nom_emplacement = :nom_emplacement AND id_emplacement = :id_emplacement";
        $stmt = $connection->prepare( $query );

        $place->setName( htmlspecialchars( strip_tags( $place->getName() ) ) );
        $place->setId( htmlspecialchars( strip_tags( $place->getId() ) ) );

        $stmt->bindParam( ":nom_emplacement", ucfirst( $place->getName() ) );
        $stmt->bindParam( ":id_emplacement", $place->getId() );

        return $stmt->execute();
    }
}

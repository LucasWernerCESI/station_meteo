<?php

namespace Classes;

use Exception;
use PDO;
use PDOException;

/**
 * Database singleton
 * Une seule instance possible en même temps
 */
class Database extends PDO {

    private static $connection = null;

    private function __construct ( string $dns, string $username, string $password, ?array $options = null ) {
        parent::__construct ( $dns, $username, $password, $options );
    }

    /**
     * Configuration de la connexion SQL (PDO)
     * @param file settings.ini
     * @return Database
     */
    public static function getConnection () : Database {

        if(is_null( self::$connection )) {
            $file = dirname(__DIR__, 1) . '/config/settings.ini';

            if (!$settings = parse_ini_file($file, TRUE)) throw new Exception('Unable to open ' . $file . '.');
    
            try {
    
                $dns = $settings['database']['driver'] . ':host=' . $settings['database']['host'] . ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') . ';dbname=' . $settings['database']['dbname'];
                self::$connection = new Database ($dns, $settings['database']['username'], $settings['database']['password']);
                self::$connection->exec("set names utf8");
    
            } catch ( PDOException $exception ) {
                echo "Database could not be connected: " . $exception->getMessage();
            }
        }

        return self::$connection;
    }
}

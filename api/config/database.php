<?php 
    class Database {

        /**
         * Configuration de la connexion SQL (PDO)
         * @param file settings.ini
         * @return object PDO
         */
        public static function getConnection($file = 'settings.ini'){

            $connection = null;
            
            if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
       
            try{
                $dns = $settings['database']['driver'] . ':host=' . $settings['database']['host'] . ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') . ';dbname=' . $settings['database']['dbname'];
           
                $connection = new PDO($dns, $settings['database']['username'], $settings['database']['password']);
                $connection->exec("set names utf8");
            }
    
            catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }

            return $connection;
        }
    }  
?>
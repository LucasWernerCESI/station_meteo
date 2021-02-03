<?php 
    class Database {

        /**
         * Objet PDO
         * @var object $connection
         */
        public $connection;

        /**
         * Configuration de la connexion SQL (PDO)
         * @param file settings.ini
         * @return object PDO
         */
        public function getConnection($file = 'settings.ini'){

            $this->connection = null;
            
            if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
       
            try{
                $dns = $settings['database']['driver'] . ':host=' . $settings['database']['host'] . ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') . ';dbname=' . $settings['database']['dbname'];
           
                $this->connection = new PDO($dns, $settings['database']['username'], $settings['database']['password']);
                $this->connection->exec("set names utf8");
            }
    
            catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }

            return $this->connection;
        }
    }  
?>
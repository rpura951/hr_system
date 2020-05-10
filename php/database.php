<?php
    require_once realpath(__DIR__ .'/../dotenv.php');

    function connect_to_db() {
        $host = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $db_name = $_ENV['DB_NAME'];
        
        // throw new Exception('Connected'. ' '. $host . ' ' . $username . ' ' . $password . ' ' . $db_name);
        $db = mysqli_connect($host, $username, $password, $db_name);
        if(mysqli_connect_errno())
            throw new Exception('Could not connect to Database');
        
        return $db;
    }    

?>
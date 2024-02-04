<?php
    global $db;
    
    $config = [
        $dbname = "mysql:host=localhost;dbname=browsermmo;",
        $login = "root",
        $password = "",
    ];
    
    try {
        $db = new PDO(...$config);
    } catch (Exception $ex) {
        throw new Exception("Could not connect to DB");
    }   
    
?>
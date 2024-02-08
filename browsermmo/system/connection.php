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
  
   /* Fetch all users+passwords
    $sql = "SELECT * FROM users";
    $stmt = $db->query($sql);
    
    $result = $stmt->fetchAll();
    
    foreach($result as $row){
        echo "username: " . $row['username'] . "<br>";
        echo "password: " . $row['password'] . "<br>";
    }
   */
    /* Create new user
    $sql = "INSERT INTO users (username,password,email) VALUES ('testtest','pass123','test@test.com')";
    $stmt = $db->query($sql);
     
     */
    
    
?>
<?php 

global $db;
$id = $_SESSION['loggedIn'];
$sql = "SELECT stats.*, users.username FROM stats 
        INNER JOIN users ON stats.id = users.id 
        WHERE stats.id='$id'";
$stmt = $db->query($sql);
$result = $stmt->fetchAll();

//$_SESSION ['money'] = $result [0]

        /*echo "<pre>";
var_dump($result);
echo "</pre>";
die;
         
         */       
?>
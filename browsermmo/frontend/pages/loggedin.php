<?php 
if(isset($_GET['message'])){
    echo $_GET['message'] . "<br>";
}


global $db;
$id = $_SESSION['loggedIn'];
$sql = "SELECT stats.*, users.username FROM stats 
        INNER JOIN users ON stats.id = users.id 
        WHERE stats.id='$id'";
$stmt = $db->query($sql);
$result = $stmt->fetchAll();


?>


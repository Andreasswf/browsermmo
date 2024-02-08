<?php

global $db;
$id = $_SESSION['loggedIn'];
$sql = "SELECT stats.*, users.username FROM stats 
        INNER JOIN users ON stats.id = users.id 
        WHERE stats.id='$id'";
$stmt = $db->query($sql);
$result = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    .container {
        width: 300px;
        padding: 20px;
        border: 2px solid black;
        background-color: white;
    }
    .bold-text {
        font-weight: bold;
        font-size: 24px;
        text-align: left;
    }
    .normal-text {
        text-align: left;
    }
</style>
</head>
<body>

<div class="container">
    <p class="bold-text"><?php echo $result[0]['username']; ?> </p>
    <p class="normal-text">Level:  <?php echo $result[0]['level']; ?> </p> 
    <p class="normal-text">XP:  <?php echo $result[0]['xp']; ?> </p>
    <p class="normal-text">Daggdroppar:  <?php echo $result[0]['money']; ?> </p>
    <p class="normal-text">Hälsa:  <?php echo $result[0]['health']; ?> </p>
    <p class="normal-text">Energi:  <?php echo $result[0]['energy']; ?> </p>
    <p class="normal-text">Slemstyrka:  <?php echo $result[0]['strength']; ?> </p>
    <p class="normal-text">Pricksäkerhet:  <?php echo $result[0]['accuracy']; ?> </p>
    <p class="normal-text">Intellekt:  <?php echo $result[0]['defense']; ?> </p>
    <p class="normal-text">Kritisk träff:  <?php echo $result[0]['crit']; ?> </p>
</div>

</body>
</html>

<?php

global $db;
include "../util/login_check.php";

// Assuming you have fetched the health and max_health values from the database
$playerHealth = $result[0]['user_health']; // Adjust this according to your database structure
$maxHealth = $result[0]['user_maxhealth']; // Adjust this according to your database structure
$playerEnergy = $result[0]['user_energy']; // Adjust this according to your database structure
$maxEnergy = $result[0]['user_maxenergy']; // Adjust this according to your database structure
$playerMoney = $result[0]['user_money']; // Adjust this according to your database structure

if(isset($_POST['heal'])) {
    // Update the health to maximum health
    $updateHealthSql = "UPDATE stats SET user_health = $maxHealth WHERE id = '$id'";
 
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SnigelKraft</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .text-box {
            width: 300px;
            border: 2px solid black;
            background-color: white;
            padding: 10px;
            margin: auto; /* Center horizontally */
            text-align: left; /* Center text within the box */
        }

        .big-text {
            font-size: 24px;
        }
    </style>
</head>
<body>

<div class="text-box">
    <p class="big-text">Välkommen till snigelshoppen!</p>
    En mystisk, men samtidigt inbjudande handelsplats. <br> <br> Här kan du köpa föremål för att förbättra din snigel.  Du kan även hela din snigel om den skadats i strid. <br> <br>
    <!-- Form to handle healing -->
    <form method="post">
        <input type="submit" name="heal" value="Hela snigel!"> Kostar 100 daggdroppar.
    </form>
</div>

<div id="centeredImage">
    <img src="https://i.postimg.cc/x8bwfLrt/06610484-b8ae-4ee6-950b-f35b37a0998d.jpg" alt="Centered Image">
</div>

</body>
</html>

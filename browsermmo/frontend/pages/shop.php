<?php

// Fetches the health and max_health values from the database
include "../util/login_check.php";

// Assuming you have fetched the health and max_health values from the database
$playerHealth = $result[0]['user_health']; // Adjust this according to your database structure
$maxHealth = $result[0]['user_maxhealth']; // Adjust this according to your database structure
$playerMoney = $result[0]['user_money']; // Adjust this according to your database structure

$playerEnergy = $result[0]['user_energy']; // Adjust this according to your database structure
$playerMaxEnergy = $result[0]['user_maxenergy']; // Adjust this according to your database structure

if(isset($_POST['heal'])) {
    // Check if player health is less than max health and player money is at least 100
    if ($playerHealth < $maxHealth && $playerMoney >= 100) {
        // Deduct 100 from player money
        $updatedMoney = $playerMoney - 100;
        // Perform the healing and money deduction
        $updateSql = "UPDATE stats SET health = $maxHealth, money = $updatedMoney WHERE id = '$id'";
        $db->query($updateSql);
        echo ("Du betalade 100 daggdroppar och din snigel blev helad!");
    } elseif ($playerHealth >= $maxHealth) {
        echo ("Din snigel har redan maxhälsa!");
    } else {
        echo ("Du har för lite daggdroppar!");
    }
}

if(isset($_POST['energize'])) {
    // Check if player health is less than max health and player money is at least 100
    if ($playerEnergy < $playerMaxEnergy && $playerMoney >= 200) {
        // Deduct 100 from player money
        $updatedMoney = $playerMoney - 200;
        // Perform the energizing and money deduction
        $updateSql = "UPDATE stats SET energy = $playerMaxEnergy, money = $updatedMoney WHERE id = '$id'";
        $db->query($updateSql);
        echo ("Du betalade 200 daggdroppar och din snigel blev pigg!");
    } elseif ($playerEnergy >= $playerMaxEnergy) {
        echo ("Din snigel är inte trött!");
    } else {
        echo ("Du har för lite daggdroppar!");
    }
}


    // Execute the SQL query to update the health in the database
    // $updateHealthResult = mysqli_query($connection, $updateHealthSql); // Uncomment this line if using mysqli
    // $updateHealthResult = $pdo->exec($updateHealthSql); // Uncomment this line if using PDO
    // Check if update was successful and handle any errors


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
    <form method="post" action="">
        <p class="big-text">Välkommen till snigelshoppen!</p>
        En mystisk, men samtidigt inbjudande handelsplats. <br> <br> Här kan du köpa föremål för att förbättra din snigel.  Du kan även hela din snigel om den skadats i strid eller vila för att återställa energi. <br> <br>
        <input type="submit" name="heal" value="Hela snigel."> Kostar 100 daggdropppar. <br>
        <input type="submit" name="energize" value="Vila under en sten."> Kostar 200 daggdropppar. <br>
    </form>
</div>


<div id="centeredImage">
    <img src="https://i.postimg.cc/x8bwfLrt/06610484-b8ae-4ee6-950b-f35b37a0998d.jpg" alt="Centered Image">
</div>



</body>
</html>

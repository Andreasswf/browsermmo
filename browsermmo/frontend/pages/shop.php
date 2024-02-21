<?php

// Fetches the health and max_health values from the database
include "../util/login_check.php";
include "../util/equip_functions.php";



if(isset($_POST['heal'])) {
    // Check if player health is less than max health and player money is at least 100
    if ($playerHealth < $totalMaxHealth && $playerMoney >= 100) {
        // Deduct 100 from player money
        $updatedMoney = $playerMoney - 100;
        // Perform the healing and money deduction
        $updateSql = "UPDATE stats SET health = $totalMaxHealth, money = $updatedMoney WHERE id = '$id'";
        $db->query($updateSql);
        echo ("Du betalade 100 daggdroppar och din snigel blev helad!");
    } elseif ($playerHealth >= $totalMaxHealth) {
        echo ("Din snigel har redan maxhälsa!");
    } else {
        echo ("Du har för lite daggdroppar! Du har bara $playerMoney daggdroppar!");
    }
}

if(isset($_POST['energize'])) {
    // Check if player health is less than max health and player money is at least 100
    if ($playerEnergy < $totalMaxEnergy && $playerMoney >= 200) {
        // Deduct 100 from player money
        $updatedMoney = $playerMoney - 200;
        // Perform the healing and money deduction
        $updateSql = "UPDATE stats SET energy = $totalMaxEnergy, money = $updatedMoney WHERE id = '$id'";
        $db->query($updateSql);
        echo ("Du betalade 200 daggdroppar och din snigel blev pigg!");
        
    } elseif ($playerEnergy >= $totalMaxEnergy) {
        echo ("Din snigel är redan pigg!");
    } else {
        echo ("Du har för lite daggdroppar! Du har bara $playerMoney daggdroppar!");
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
        En mystisk, men samtidigt inbjudande handelsplats. <br> <br> Här kan du köpa föremål för att förbättra din snigel.  Du kan även hela din snigel om den skadats i strid eller vila för att återställa energi. <br> 
        </div> <br>
    <div class="text-box">
        <input type="submit" name="heal" value="Hela snigel."> Kostar 100 daggdropppar.</input> <br>
        <input type="submit" name="energize" value="Vila under en sten."> Kostar 200 daggdropppar.</input> <br>
    </form>
</div>


<div id="centeredImage">
    <img src="https://i.postimg.cc/x8bwfLrt/06610484-b8ae-4ee6-950b-f35b37a0998d.jpg" alt="Centered Image">
</div>



</body>
</html>

<?php

include "../util/login_check.php";

                

// Assuming you have fetched the health and max_health values from the database
$playerHealth = $result[0]['health']; // Adjust this according to your database structure
$maxHealth = $result[0]['maxhealth']; // Adjust this according to your database structure
$playerEnergy = $result[0]['energy']; // Adjust this according to your database structure
$playerMoney = $result[0]['money']; // Adjust this according to your database structure
$playerXp = $result[0]['xp']; // Adjust this according to your database structure





if (!isset($_SESSION['monster']['init']) || $_SESSION['monster']['init'] == false || $_SESSION['monster']['hp'] <= 0) {
    $_SESSION['monster']['hp']  = 10;
    $_SESSION['monster']['init'] = true;
    
    $new_energy = $result[0]['energy'] - 1;
                $sql_update_energy = "UPDATE stats SET energy = $new_energy, lastenergyupdate=NOW() WHERE id = $id";
                $db->query($sql_update_energy);
    
}
$message='';



if(isset($_POST['attack'])) {
    $chance_to_hit = rand(1, 100); // Generate a random number between 1 and 100
    $monster_attack = rand(1, 100); // Generate a random number between 1 and 100

//DEAL AND TAKE DAMAGE
    
    
    if($chance_to_hit <= 80 ) {
        $message .= "<p>Du träffade monstret!</p>";
        $_SESSION['monster']['hp']  -= 1;
    } else {
        $message .= "<p>Du missade!</p>";
    }
    
    if($monster_attack <= 30 ) {
        $message .= "<p>Monstret slog sedan tillbaka!</p>";
        $playerHealth -= 1;
        // Update health in the database
        $updateHealthSql = "UPDATE stats SET health = $playerHealth WHERE id = '$id'";
        $db->query($updateHealthSql);
    } else {
        $message .= "<p>Monstret försökte slå tillbaka, men missade!</p>";
    }
    
    
    // PLAYER DEATH
if($playerHealth <= 0 ) {
    $message .= "<p>Du har stupat! Du förlorade några daggdroppar och lite XP! </p>";
   
    // Update health in the database
    $updateHealthSql = "UPDATE stats SET health = $maxHealth WHERE id = '$id'";
    $db->query($updateHealthSql);
    $hideButtons = true; // Hide buttons if player's health reaches zero
    $_SESSION['monster']['init'] = false;
    

    
    // Deduct 10% of 'xp' if the player has more than 1 xp
    $xp = $result[0]['xp'];
    if ($xp > 1) {
        $xpLoss = ceil($xp * 0.1); // Calculate the loss
        $xpLoss = max(1, $xpLoss); // Ensure at least 1 xp loss
        $newXp = $xp - $xpLoss; // Calculate new xp
        $updateXpSql = "UPDATE stats SET xp = $newXp WHERE id = '$id'";
        $db->query($updateXpSql);
        

    }
}
    
} elseif(isset($_POST['flee'])) {
    $chance_to_flee = rand(1, 100); // Generate a random number between 1 and 100

    if($chance_to_flee <= 25) {
        // Return to adventures.php
        header("Location: ?page=adventures");
        exit();
    } else {
        // Take 1 damage
        $playerHealth -= 1;
        // Update health in the database
        $updateHealthSql = "UPDATE stats SET health = $playerHealth WHERE id = '$id'";
        $db->query($updateHealthSql);
        $message .= "<p>Du försökte fly, men monstret skadade dig!</p>";
    }
} 

// Set $hideButtons based on player's health and monster's health
$hideButtons = ($playerHealth <= 0||$_SESSION['monster']['hp'] <= 0);

if ($_SESSION['monster']['hp'] <= 0) {
    $message .= "<p>Du dödade monstret! :D </p>";

    // Give the player a random amount of money between 20 and 50
    $moneyGained = rand(20, 50);
    $playerMoney += $moneyGained;
    $message .= "<p>Du fick $moneyGained daggdroppar!</p>";

    // Give the player 10 XP
    $playerXp += 10;
    $message .= "<p>Du fick 10 XP!</p>";
    
    // ADD TO THE DATABASE
    
     $updateMoneySql = "UPDATE stats SET money = $playerMoney WHERE id = '$id'";
        $db->query($updateMoneySql);
        
        $updateXpSql = "UPDATE stats SET xp = $playerXp WHERE id = '$id'";
        $db->query($updateXpSql);
        
        
}
    
    
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat Test</title>
    <style>
        .health-bar {
            position: relative;
            width: 300px;
            height: 30px;
            border: 1px solid black;
            margin-bottom: 10px;
        }

        .health-bar-inner {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background-color: green; /* Default color */
        }

        .health-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: black;
            font-weight: bold;
        }

        .monster-health-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: black;
            font-weight: bold;
        }

        .yellow-bar {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <!-- HTML code for health bars -->
    <div id="playerHealthBar" class="health-bar">
        <div id="playerHealthBarInner" class="health-bar-inner" style="width: <?php echo ($playerHealth / $maxHealth) * 100; ?>%;">
        </div>
        <span class="health-text">Din hälsa: <?php echo $playerHealth; ?></span>
    </div>

    <div id="monsterHealthBar" class="health-bar">
        <div id="monsterHealthBarInner" class="health-bar-inner yellow-bar" style="width: <?php echo ($_SESSION['monster']['hp'] / 10) * 100; ?>%;">
        </div>
        <span class="monster-health-text">Monster: <?php echo $_SESSION['monster']['hp']; ?></span>
    </div>

    <!-- HTML code for buttons -->
    <form action="?page=combat_test" method="post">
        <?php if(!$hideButtons): ?>
        <input type="submit" name="attack" value="Attackera">
        <input type="submit" name="flee" value="Fly från monstret">
        <?php else: ?>
        <input type="button" value="Tillbaka till skogen" onclick="location.href='?page=forest';">
        <?php endif; ?>
    </form>

    
    
    
    <?php
    echo $message;
    ?>
</body>
</html>
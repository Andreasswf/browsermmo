<?php

include "../util/login_check.php";
include "../util/equip_functions.php";

function checkLevelUp($currentLevel, $currentXp) {
    //LEVELING UP LOGIC
    // For example, if you want the player to level up when they have double the current level's XP requirement:
    $xpRequired = pow(2, $currentLevel - 1) * 100; // Adjust the multiplier and base XP as needed
    return $currentXp >= $xpRequired;
}

$playerLevel = $result[0]['level']; // Move playerLevel here

$maxHealth = $result[0]['user_maxhealth']; // Adjust this according to your database structure
$playerEnergy = $result[0]['user_energy']; // Adjust this according to your database structure
$playerMoney = $result[0]['user_money']; // Adjust this according to your database structure
$playerXp = $result[0]['xp']; // Adjust this according to your database structure
$playerAccuracy = $totalAccuracy + 25; // Pricksäkerhet
$playerDamage = $totalStrength * 0.1;
$playerCrit = $totalCrit * 0.1;

// MONSTER BATTLE STARTS
if (!isset($_SESSION['monster']['init']) || $_SESSION['monster']['init'] == false || $_SESSION['monster']['hp'] <= 0) {
    $_SESSION['monster']['hp']  = 20;
    $_SESSION['monster']['init'] = true;
    
    $new_energy = $result[0]['energy'] - 1;
    $sql_update_energy = "UPDATE stats SET energy = $new_energy, lastenergyupdate=NOW() WHERE id = $id";
    $db->query($sql_update_energy);
}

$message='';

if(isset($_POST['attack'])) {
    $chance_to_hit = rand(1, 100); // Generate a random number between 1 and 100
    $monster_attack = rand(1, 100); // Generate a random number between 1 and 100

    // DEAL AND TAKE DAMAGE
    if($chance_to_hit <= $playerAccuracy ) {
    $chance_to_crit = rand(1, 100); 
    $critattack = $chance_to_hit <= $playerCrit;
    
       $_SESSION['monster']['hp'] -= round($critattack ? $playerDamage * 2 : $playerDamage);
       $message .= $critattack ? "<p>Kritisk träff!</p>" : "<p>Du träffade monstret!</p>"; 
       
             
    
        
        
    } else {
        $message .= "<p>Du missade!</p>";
    }
    
    if($monster_attack <= 20 ) {
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
        
       
        // Update health in the database
        $updateHealthSql = "UPDATE stats SET health = $totalMaxHealth WHERE id = '$id'";
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
            
            if ($playerMoney > 0) {
                $moneyLost = round(0.1 * $playerMoney);
                $playerMoney -= $moneyLost;
                $message .= "<p>Du har stupat! Du förlorade $xpLoss XP och $moneyLost daggdroppar!</p>";
                
                $updateMoneySql = "UPDATE stats SET money = $playerMoney WHERE id = '$id'";
                $db->query($updateMoneySql);
            }
        }
    }
    
    //FLEEING
    
} elseif(isset($_POST['flee'])) {
    $chance_to_flee = rand(1, 100); // Generate a random number between 1 and 100

    if($chance_to_flee <= 25) {
        $_SESSION['monster']['init'] = false;
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
    
    // Check if player health reaches 0 while fleeing
    if($playerHealth <= 0 ) {
        
       
        if ($playerMoney > 0) {
            $moneyLost = round(0.1 * $playerMoney);
            $playerMoney -= $moneyLost;
            
            
            // Deduct 10% of 'xp' if the player has more than 1 xp
            $xp = $result[0]['xp'];
            if ($xp > 1) {
                $xpLoss = ceil($xp * 0.1); // Calculate the loss
                $xpLoss = max(1, $xpLoss); // Ensure at least 1 xp loss
                $newXp = $xp - $xpLoss; // Calculate new xp
                $updateXpSql = "UPDATE stats SET xp = $newXp WHERE id = '$id'";
                $db->query($updateXpSql);
                
                $updateMoneySql = "UPDATE stats SET money = $playerMoney WHERE id = '$id'";
                $db->query($updateMoneySql);
                
                $message .= "<p>Du har stupat! Du förlorade $xpLoss XP och $moneyLost daggdroppar!</p>";
                
                // Update health in the database
                $updateHealthSql = "UPDATE stats SET health = $totalMaxHealth WHERE id = '$id'";
                $db->query($updateHealthSql);
                $hideButtons = true; // Hide buttons if player's health reaches zero
                $_SESSION['monster']['init'] = false;
            }
        }
    }
}

// Set $hideButtons based on player's health and monster's health
$hideButtons = ($playerHealth <= 0 || $_SESSION['monster']['hp'] <= 0);

// MONSTER DEATH
if ($_SESSION['monster']['hp'] <= 0) {
    $message .= "<p>Du dödade monstret! </p>";

    // Give the player a random amount of money between 20 and 50
    $moneyGained = rand(20, 50);
    $playerMoney += $moneyGained;
    

    // Give the player 10 XP
    $playerXp += 10;
    $message .= "<p>Du fick $moneyGained daggdroppar och 10 XP!</p>";
    
    // Check if the player has enough XP to level up
    if (checkLevelUp($playerLevel, $playerXp)) {
        $playerLevel++; // Increment player level
        
        // Update player's level in the database
        $updateLevelSql = "UPDATE stats SET level = $playerLevel WHERE id = '$id'";
        $db->query($updateLevelSql);
        $statpoints = $result[0]['statpoints'] + 10;
        $updateStatpointsSql = "UPDATE stats SET statpoints = $statpoints WHERE id = '$id'";
        $db->query($updateStatpointsSql);
        $message .= "<p>Grattis! Du har nått till nivå $playerLevel och fått 10 statspoäng att fördela fritt!</p>";
    }
    
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
        <div id="playerHealthBarInner" class="health-bar-inner" style="width: <?php echo ($playerHealth / $totalMaxHealth) * 100; ?>%;">
        </div>
        <span class="health-text">Din hälsa: <?php echo $playerHealth; ?></span>
    </div>

    <div id="monsterHealthBar" class="health-bar">
        <div id="monsterHealthBarInner" class="health-bar-inner yellow-bar" style="width: <?php echo ($_SESSION['monster']['hp'] / 20) * 100; ?>%;">
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

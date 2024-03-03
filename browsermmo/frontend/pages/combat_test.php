<?php

$monsterDifficulty = 1; // Default monster difficulty
$hideButtons = false; // Initialize hideButtons variable

include "../util/login_check.php";
include "../util/equip_functions.php";

function checkLevelUp($currentLevel, $currentXp) {
    //LEVELING UP LOGIC
    // For example, if you want the player to level up when they have double the current level's XP requirement:
    $xpRequired = pow(2, $currentLevel - 1) * 50; // Adjust the multiplier and base XP as needed
    return $currentXp >= $xpRequired;
}

$playerLevel = $result[0]['level']; // Move playerLevel here

$maxHealth = $result[0]['user_maxhealth']; // Adjust this according to your database structure
$playerEnergy = $result[0]['user_energy']; // Adjust this according to your database structure
$playerMoney = $result[0]['user_money']; // Adjust this according to your database structure
$playerXp = $result[0]['xp']; // Adjust this according to your database structure
$playerAccuracy = $totalAccuracy + 35; // Pricksäkerhet
$playerDamage = $totalStrength * 0.1;
$playerCrit = $totalCrit * 0.1;
$playerDefense = $totalDefense;

// Set $monsterDifficulty back to 1 whenever the page is accessed
if (!isset($_SESSION['monsterDifficulty'])) {
    $_SESSION['monsterDifficulty'] = 1;
} else {
    $monsterDifficulty = $_SESSION['monsterDifficulty'];
}

// MONSTER BATTLE STARTS
if (!isset($_SESSION['monster']['init']) || $_SESSION['monster']['init'] == false || $_SESSION['monster']['hp'] <= 0) {
    $dieRoll = rand(1, 4);
    switch ($dieRoll) {
        case 1:
            $_SESSION['monster']['monsterName'] = "Fjärilslarv";
            break;
        case 2:
            $_SESSION['monster']['monsterName'] = "Nyckelpiga";
            break;
        case 3:
            $_SESSION['monster']['monsterName'] = "Myra";
            break;
        case 4:
            $_SESSION['monster']['monsterName'] = "Skalbagge";
            break;
    }
    
    $monsterName = $_SESSION['monster']['monsterName']; // Retrieve monster name
    
    // Echo when a monster is initialized
    echo "";
    
    $_SESSION['monster']['hp']  = 10 + ($monsterDifficulty - 1) * 2; // Adjust monster health based on difficulty
    $_SESSION['monster']['damage'] = 1 + ($monsterDifficulty - 1) * 1; // Adjust monster damage based on difficulty
    $_SESSION['monster']['fleeChance'] = 25 - $monsterDifficulty; // Adjust monster flee chance based on difficulty
    
    $_SESSION['monster']['init'] = true;
    
    $new_energy = $result[0]['energy'] - 1;
    $sql_update_energy = "UPDATE stats SET energy = $new_energy, lastenergyupdate=NOW() WHERE id = $id";
    $db->query($sql_update_energy);
}


$message='';

if(isset($_POST['attack'])) {
    $chance_to_hit = rand(1, 100); // Generate a random number between 1 and 100
    $monster_attack = rand(1, 100);

    // Adjust monster attack chance based on player defense
    $monster_attack += $playerDefense * 0.1; // Decrease chance of monster hitting by 0.1% per point of defense
    
    $monsterName = $_SESSION['monster']['monsterName']; // Retrieve monster name
    $monsterLevel = $_SESSION['monster']['damage']; // Retrieve monster level
    
    // DEAL AND TAKE DAMAGE
    if($chance_to_hit <= $playerAccuracy ) {
        $chance_to_crit = rand(1, 100); 
        $critattack = $chance_to_hit <= $playerCrit;

        $_SESSION['monster']['hp'] -= round($critattack ? $playerDamage * 2 : $playerDamage);
        $message .= $critattack ? "<p>Kritisk träff!</p>" : "<p>Du träffade $monsterName (nivå $monsterLevel)!</p>"; 
    } else {
        $message .= "<p>Du missade!</p>";
    }
    
    if($monster_attack <= 20 + $monsterDifficulty) {
       $message .= '<p class="monster-hit-text">' . $monsterName . ' (nivå ' . $monsterLevel . ') slog sedan tillbaka!</p>'; 
        $playerHealth -= $_SESSION['monster']['damage'];
        // Update health in the database
        $updateHealthSql = "UPDATE stats SET health = $playerHealth WHERE id = '$id'";
        $db->query($updateHealthSql);
    } else {
        $message .= '<p class="monster-action-text">' . $monsterName . ' (nivå ' . $monsterLevel . ') försökte slå tillbaka, men missade!</p>';

    }
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
    
 elseif(isset($_POST['flee'])) {
    $chance_to_flee = rand(1, 100); // Generate a random number between 1 and 100

    if($chance_to_flee <= $_SESSION['monster']['fleeChance']) {
        $_SESSION['monster']['init'] = false;
        header("Location: ?page=adventures");
        exit();
    } else {
        // Take damage
        $playerHealth -= $_SESSION['monster']['damage'];
        // Update health in the database
        $updateHealthSql = "UPDATE stats SET health = $playerHealth WHERE id = '$id'";
        $db->query($updateHealthSql);
        $monsterName = $_SESSION['monster']['monsterName']; // Retrieve monster name
        $monsterLevel = $_SESSION['monster']['damage']; // Retrieve monster level
        $message .= "<p>Du försökte fly, men $monsterName (nivå $monsterLevel) skadade dig!</p>";
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
    $monsterName = $_SESSION['monster']['monsterName']; // Retrieve monster name
    $monsterLevel = $_SESSION['monster']['damage']; // Retrieve monster level
    $message .= "<p>Du dödade $monsterName (nivå $monsterDifficulty)! </p>";

    // Give the player a random amount of money between 20 and 50
    $moneyGained = rand(20, 50) + ($monsterDifficulty - 1) * 10; // Add money based on monster difficulty
    $playerMoney += $moneyGained;

    // Give the player 10 XP
    $playerXp += 10 + ($monsterDifficulty - 1) * 2; // Add XP based on monster difficulty
    $message .= "<p>Du fick $moneyGained daggdroppar och " . (10 + ($monsterDifficulty - 1) * 2) . " XP!</p>";

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

 
    
    // Roll a number from 1-100
    $rollResult = rand(1, 100);

    // Check if the result is 30 or less
    if ($rollResult <= 30 + $monsterDifficulty) {
        $emptySlot = array_search(0, $resultInventory);
        if ($emptySlot !== false) {

            // Add 1 random item with an id from 1-25 to the first empty slot of the player's inventory
            $randomItemId = mt_rand(1, 27);

            // Fetch item name from the 'item' table based on the random item ID
            $sqlItemName = "SELECT name FROM item WHERE item_id = $randomItemId";
            $stmtItemName = $db->query($sqlItemName);
            $itemNameResult = $stmtItemName->fetch(PDO::FETCH_ASSOC);
            $itemName = $itemNameResult['name'];

            $resultInventory[$emptySlot] = $randomItemId;

            // Update player inventory
            $inventoryUpdate = [];
            foreach ($resultInventory as $key => $value) {
                if ($key !== 'id') {
                    $inventoryUpdate[] = "`$key` = '$value'";
                }
            }
            $inventoryUpdateQuery = implode(', ', $inventoryUpdate);
            $db->query("UPDATE playerInventory SET $inventoryUpdateQuery WHERE id = '$id'");

            // Message indicating the item obtained
            $message .= "<p>Du hittade $itemName!</p>";
        } else {
            $message .= "<p>Du har ingen plats i din väska för fler föremål!</p>";
        }
    }
}



// Increase monster difficulty when the "Gå djupare in i skogen" button is clicked
if (isset($_POST['explore']) && $playerEnergy >= 1) { // Check if player has energy
    $_SESSION['monsterDifficulty']++;
    $_SESSION['monster']['init'] = false; // Reset monster initialization to generate a new monster with the updated difficulty
    header("Location: ?page=combat_test");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat Test</title>
    <style>
       .monster-hit-text
       {
          
        color: red;
        }
        
               .monster-action-text
       {
          
        color: yellow;
        }
        
        
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
    
    <div id="playerHealthBar" class="health-bar">
        <div id="playerHealthBarInner" class="health-bar-inner" style="width: <?php echo ($playerEnergy / $totalMaxEnergy) * 100; ?>%;">
        </div>
        <span class="health-text">Din energi: <?php echo $playerEnergy; ?></span>
    </div>

    <div id="monsterHealthBar" class="health-bar">
        <div id="monsterHealthBarInner" class="health-bar-inner yellow-bar" style="width: <?php echo ($_SESSION['monster']['hp'] / (20 * $monsterDifficulty)) * 100; ?>%;">
        </div>
        <span class="monster-health-text"><?php echo $_SESSION['monster']['monsterName']; ?> <?php echo $_SESSION['monster']['hp']; ?></span>
    </div>

    <!-- HTML code for buttons -->
    <form action="?page=combat_test" method="post">
        <?php if(!$hideButtons): ?>
        <input type="submit" name="attack" value="Attackera">
        <input type="submit" name="flee" value="Fly från <?php echo $_SESSION['monster']['monsterName']; ?>">
        <?php else: ?>
        <input type="button" value="Tillbaka till skogen" onclick="location.href='?page=forest';">
        <?php endif; ?>
    </form>

    <?php if ($_SESSION['monster']['hp'] <= 0 && $playerEnergy >= 1): ?>
    <form action="?page=combat_test" method="post">
        <input type="submit" name="explore" value="Gå djupare in i skogen">
    </form>
    <?php endif; ?>

    <?php
    echo $message;
    ?>
</body>
</html>

<?php
include "../util/login_check.php";
include "../util/equip_functions.php";

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data
    $id = $_POST['user_id'];
    $totalStatPoints = $_POST['total_statpoints'];
    $maxHealth = $_POST['maxhealth'];
    $maxEnergy = $_POST['maxenergy'];
    $strength = $_POST['strength'];
    $accuracy = $_POST['accuracy'];
    $intellect = $_POST['intellect'];
    $crit = $_POST['crit'];

    // Calculate total allocated points
    $totalAllocatedPoints = $maxHealth + $maxEnergy + $strength + $accuracy + $intellect + $crit;

    // Ensure the total allocated points don't exceed available points
    if($totalAllocatedPoints <= $totalStatPoints) {
        // Update user's stats in the database
        $sql = "UPDATE stats 
                SET maxhealth = maxhealth + ?, 
                    maxenergy = maxenergy + ?, 
                    strength = strength + ?, 
                    accuracy = accuracy + ?, 
                    intellect = intellect + ?, 
                    crit = crit + ? 
                WHERE id = $id";
        $stmt = $db->prepare($sql);
        $stmt->execute([$maxHealth, $maxEnergy, $strength, $accuracy, $intellect, $crit]);

        // Update user's remaining stat points
        $remainingStatPoints = $totalStatPoints - $totalAllocatedPoints;
        $sqlUpdateStatPoints = "UPDATE stats SET statpoints = ? WHERE id = $id";
        $stmtUpdateStatPoints = $db->prepare($sqlUpdateStatPoints);
        $stmtUpdateStatPoints->execute([$remainingStatPoints]);
        
        // Redirect or display a success message
        header("Location: ?page=profile");
        // exit;
        $resultMessage = "Stats updated successfully!";
    } else {
        $resultMessage = "You cannot allocate more points than available stat points.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>
    <style>
        .rare-item-name {
            font-weight: bold;
            color: darkgreen;
        }

        .super-rare-item-name {
            font-weight: bold;
            color: darkblue;
        }

        .epic-item-name {
            font-weight: bold;
            color: purple;
        }

        .common-item-name {
            color: black;
        }
    </style>
</head>
<body>

<?php if(!empty($result)): ?>
    <div class="container">
        <p class="bold-text"><?php echo $result[0]['user_username']; ?> </p>
        <p class="normal-text">Nivå:  <?php echo $result[0]['user_level']; ?> </p> 
        <p class="normal-text">XP:  <?php echo $result[0]['user_xp']; ?> </p>
        <p class="normal-text">Daggdroppar:  <?php echo $result[0]['user_money']; ?> </p>
        <p class="normal-text">Hälsa:  <?php echo $result[0]['user_health']; ?> / <?php echo $totalMaxHealth; ?> </p>
        <p class="normal-text">Energi:  <?php echo $result[0]['user_energy']; ?> / <?php echo $totalMaxEnergy; ?> </p>
        <p class="normal-text">Slemstyrka:  <?php echo $totalStrength; ?> </p>
        <p class="normal-text">Pricksäkerhet:  <?php echo $totalAccuracy; ?> </p>
        <p class="normal-text">Intellekt:  <?php echo $totalIntellect; ?> </p>
        <p class="normal-text">Kritisk träff:  <?php echo $totalCrit; ?> </p>
    </div>
<?php else: ?>
    <p>No user data found.</p>
<?php endif; ?>

<?php if(!empty($result) && $result[0]['user_statpoints'] > 0): ?>
    <div class="container"> 
        <h2 id="available-points">Du har poäng att fördela!</h2>
        <form id="stat-form" method="post" action="">
            <input type="hidden" name="user_id" value="<?php echo $result[0]['id']; ?>">
            <input type="hidden" name="total_statpoints" value="<?php echo $result[0]['user_statpoints']; ?>">
            <label for="maxhealth">Maxhälsa:</label>
            <input type="number" name="maxhealth" id="maxhealth" value="0" min="0" max="<?php echo $result[0]['user_statpoints']; ?>"><br><br>

            <label for="maxenergy">Maxenergi:</label>
            <input type="number" name="maxenergy" id="maxenergy" value="0" min="0" max="<?php echo $result[0]['user_statpoints']; ?>"><br><br>

            <label for="strength">Slemstyrka:</label>
            <input type="number" name="strength" id="strength" value="0" min="0" max="<?php echo $result[0]['user_statpoints']; ?>"><br><br>

            <label for="accuracy">Pricksäkerhet:</label>
            <input type="number" name="accuracy" id="accuracy" value="0" min="0" max="<?php echo $result[0]['user_statpoints']; ?>"><br><br>

            <label for="intellect">Intellekt:</label>
            <input type="number" name="intellect" id="intellect" value="0" min="0" max="<?php echo $result[0]['user_statpoints']; ?>"><br><br>

            <label for="crit">Kritisk träff:</label>
            <input type="number" name="crit" id="crit" value="0" min="0" max="<?php echo $result[0]['user_statpoints']; ?>"><br><br>

            <input type="submit" name="submit" value="Spara">
        </form>
        <p id="remaining-points">Återstående statspoäng: <?php echo $result[0]['user_statpoints']; ?></p>
    </div>

    <script>
        // JavaScript to update remaining stat points dynamically
        const totalStatPoints = <?php echo $result[0]['user_statpoints']; ?>;
        const inputs = document.querySelectorAll('#stat-form input[type="number"]');
        const remainingPointsElement = document.getElementById('remaining-points');

        function updateRemainingPoints() {
            let totalAllocatedPoints = 0;
            inputs.forEach(input => {
                totalAllocatedPoints += parseInt(input.value);
            });

            const remainingPoints = totalStatPoints - totalAllocatedPoints;
            remainingPointsElement.textContent = 'Återstående statspoäng: ' + remainingPoints;
        }

        inputs.forEach(input => {
            input.addEventListener('input', updateRemainingPoints);
        });
    </script>
<?php endif; ?>


<div class="container">
    <p class="bold-text">Utrustning: </p>
    <div>
        <?php // SHOW USER EQUIPMENT
        if (!empty($resultEquipment)) {
            for ($i = 1; $i <= 8; $i++) {
                $equipmentSlot = "slot_$i";
                $itemId = $resultEquipment[$equipmentSlot];
                if (!empty($itemId)) {
                    // Fetch item details from the 'item' table based on item_id
                    $sqlItem = "SELECT * FROM item WHERE item_id = $itemId";
                    $stmtItem = $db->query($sqlItem);
                    $itemResult = $stmtItem->fetch(PDO::FETCH_ASSOC);
                    $itemName = $itemResult ? $itemResult['name'] : "Ledig plats.";
                    $itemDescription = $itemResult ? $itemResult['description'] : "";
                    $itemRarity = $itemResult ? $itemResult['rarity'] : "";

                    // Apply appropriate class based on rarity
                    $itemNameClass = '';
                    switch ($itemRarity) {
                        case 'rare':
                            $itemNameClass = 'rare-item-name';
                            break;
                        case 'super_rare':
                            $itemNameClass = 'super-rare-item-name';
                            break;
                        case 'epic':
                            $itemNameClass = 'epic-item-name';
                            break;
                        default:
                            $itemNameClass = 'common-item-name';
                            break;
                    }

                    // Add a button to remove the item
                    echo "<div><p><span class='$itemNameClass'>$itemName</span> <i>($itemDescription)</i></p>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='item_id' value='$itemId'>";
                    echo "<input type='submit' name='remove' value='Ta av'></form></div>";
                } else {
                    echo "<div><p class='normal-text'>Ledig plats.</p></div>";
                }
            }
        } else {
            echo "<div><p class='normal-text'>No user equipment found.</p></div>";
        }
        ?>
    </div>
</div>

<div class="container">
    <p class="bold-text">Föremål i väskan: </p>
    <div>
        <?php // SHOW USER INVENTORY
        if (!empty($resultInventory)) {
            for ($i = 1; $i <= 8; $i++) {
                $inventorySlot = "slot_$i";
                $itemId = $resultInventory[$inventorySlot];
                if (!empty($itemId)) {
                    // Fetch item details from the 'item' table based on item_id
                    $sqlItem = "SELECT name, description, rarity FROM item WHERE item_id = $itemId";
                    $stmtItem = $db->query($sqlItem);
                    $itemResult = $stmtItem->fetch(PDO::FETCH_ASSOC);
                    $itemName = $itemResult ? $itemResult['name'] : "Ledig plats.";
                    $itemDescription = $itemResult ? $itemResult['description'] : "";
                    $itemRarity = $itemResult ? $itemResult['rarity'] : "";

                    // Apply appropriate class based on rarity
                    $itemNameClass = '';
                    switch ($itemRarity) {
                        case 'rare':
                            $itemNameClass = 'rare-item-name';
                            break;
                        case 'super_rare':
                            $itemNameClass = 'super-rare-item-name';
                            break;
                        case 'epic':
                            $itemNameClass = 'epic-item-name';
                            break;
                        default:
                            $itemNameClass = 'common-item-name';
                            break;
                    }

                    // BUTTONS FOR EQUIP AND TOSS
                    echo "<div><p><span class='$itemNameClass'>$itemName</span> <i>($itemDescription)</i></p>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='item_id' value='$itemId'>";
                    echo "<input type='submit' name='equip' value='Ta på'>";
                    echo "&nbsp;"; // Add a non-breaking space for spacing
                    echo "<input type='submit' name='toss' value='Släng'>";
                    echo "</form></div>";
                } else {
                    echo "<div><p class='normal-text'>Ledig plats.</p></div>";
                }
            }
        } else {
            echo "<div><p class='normal-text'>No user inventory found.</p></div>";
        }
        ?>
    </div>
</div>
</body>
</html>

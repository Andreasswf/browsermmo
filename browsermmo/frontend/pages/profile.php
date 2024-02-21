<?php
include "../util/login_check.php";
include "../util/equip_functions.php";

?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SnigelKraft</title>


</head>
<body>


    <div class="container">
        
        <?php if(!empty($result)): ?>
        <p class="bold-text"><?php echo $result[0]['user_username']; ?> </p>
        <p class="normal-text">Level:  <?php echo $result[0]['user_level']; ?> </p> 
        <p class="normal-text">XP:  <?php echo $result[0]['user_xp']; ?> </p>
        <p class="normal-text">Daggdroppar:  <?php echo $result[0]['user_money']; ?> </p>
        <p class="normal-text">Hälsa:  <?php echo $result[0]['user_health']; ?> / <?php echo $totalMaxHealth; ?> </p>
        <p class="normal-text">Energi:  <?php echo $result[0]['user_energy']; ?> / <?php echo $totalMaxEnergy; ?> </p>
        <p class="normal-text">Slemstyrka:  <?php echo $totalStrength; ?> </p>
        <p class="normal-text">Pricksäkerhet:  <?php echo $totalAccuracy; ?> </p>
        <p class="normal-text">Intellekt:  <?php echo $result[0]['user_intellect']; ?> </p>
        <p class="normal-text">Kritisk träff:  <?php echo $result[0]['user_crit']; ?> </p>
        <?php else: ?>
        <p>No user data found.</p>
        <?php endif; ?>
    </div>

    <div class="container">
        <p class="bold-text">Utrustning: </p>
        <div>
            <?php //SHOW USER EQUIPMENT
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
$itemStrength = $itemResult ? $itemResult['strength'] : "";
$itemMaxHealth = $itemResult ? $itemResult['maxhealth'] : "";
$itemMaxEnergy = $itemResult ? $itemResult['maxenergy'] : "";
$itemIntellect = $itemResult ? $itemResult['intellect'] : "";
$itemHealth = $itemResult ? $itemResult['health'] : "";
$itemEnergy = $itemResult ? $itemResult['energy'] : "";
$itemDefense = $itemResult ? $itemResult['defense'] : "";
$itemCrit = $itemResult ? $itemResult['crit'] : "";
$itemAccuracy = $itemResult ? $itemResult['accuracy'] : "";



                        // Add a button to remove the item
                        echo "<div><p class='normal-text'>$itemName (<i>$itemDescription</i>)</p>";
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
            <?php //SHOW USER INVENTORY
            if (!empty($resultInventory)) {
                for ($i = 1; $i <= 8; $i++) {
                    $inventorySlot = "slot_$i";
                    $itemId = $resultInventory[$inventorySlot];
                    if (!empty($itemId)) {
                        // Fetch item details from the 'item' table based on item_id
                        $sqlItem = "SELECT name, description FROM item WHERE item_id = $itemId";
                        $stmtItem = $db->query($sqlItem);
                        $itemResult = $stmtItem->fetch(PDO::FETCH_ASSOC);
                        $itemName = $itemResult ? $itemResult['name'] : "Ledig plats.";
                        $itemDescription = $itemResult ? $itemResult['description'] : "";

                        // BUTTONS FOR EQUIP AND TOSS
echo "<div><p class='normal-text'>$itemName <i>($itemDescription)</i></p>";
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
</div>

    
    
</body>
</html>

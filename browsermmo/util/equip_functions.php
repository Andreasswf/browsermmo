<?php

// Fetching player stats
$playerHealth = $result[0]['user_health']; // Adjust this according to your database structure
$playerMaxHealth = $result[0]['user_maxhealth']; // Adjust this according to your database structure
$playerEnergy = $result[0]['user_energy']; // Adjust this according to your database structure
$playerMaxEnergy = $result[0]['user_maxenergy']; // Adjust this according to your database structure
$playerMoney = $result[0]['user_money']; // Adjust this according to your database structure
$playerXp = $result[0]['xp']; // Adjust this according to your database structure
$playerAccuracy = $result[0]['user_accuracy']; // Pricksäkerhet
$playerIntellect = $result[0]['user_intellect']; // Intellekt
$playerCrit = $result[0]['user_crit']; // Kritisk träff
$playerStrength = $result[0]['user_strength']; // Slemstyrka


// Fetch player equipment
$sqlEquipment = "SELECT * FROM playerEquipment WHERE id = '$id'";
$stmtEquipment = $db->query($sqlEquipment);
$resultEquipment = $stmtEquipment->fetch(PDO::FETCH_ASSOC);

// Fetch player inventory
$sqlInventory = "SELECT * FROM playerInventory WHERE id = '$id'";
$stmtInventory = $db->query($sqlInventory);
$resultInventory = $stmtInventory->fetch(PDO::FETCH_ASSOC);

// Initialize a variable to hold the total equipped item stats + player stats
$totalMaxEnergy = $playerMaxEnergy;
$totalMaxHealth = $playerMaxHealth;
$totalStrength = $playerStrength;
$totalAccuracy = $playerAccuracy;

// Loop through all equipment slots
for ($i = 1; $i <= 8; $i++) {
    $equipmentSlot = "slot_$i";
    $itemId = $resultEquipment[$equipmentSlot];

    // Fetch item details from the 'item' table based on item_id
    $sqlItem = "SELECT * FROM item WHERE item_id = $itemId";
    $stmtItem = $db->query($sqlItem);
    $itemResult = $stmtItem->fetch(PDO::FETCH_ASSOC);
    
    // Add the max energy of the item to the total max energy
    if ($itemResult) {
        $totalMaxEnergy += $itemResult['maxenergy'];
        $totalMaxHealth += $itemResult['maxhealth'];
        $totalAccuracy += $itemResult['accuracy'];
        $totalStrength += $itemResult['strength'];
        
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['remove'])) {
        $itemId = $_POST['item_id'];
        // Find the slot in player equipment where the item is stored and set it to 0
        $slotIndex = array_search($itemId, $resultEquipment);
        if ($slotIndex !== false) {
            $resultEquipment[$slotIndex] = 0;
            // Find the first empty slot in player inventory and set it to the removed item's id
            $emptySlot = array_search(0, $resultInventory);
            if ($emptySlot !== false) {
                $resultInventory[$emptySlot] = $itemId;
                // Update player equipment
                $equipmentUpdate = [];
                foreach ($resultEquipment as $key => $value) {
                    if ($key !== 'id') {
                        $equipmentUpdate[] = "`$key` = '$value'";
                    }
                }
                $equipmentUpdateQuery = implode(', ', $equipmentUpdate);
                $db->query("UPDATE playerEquipment SET $equipmentUpdateQuery WHERE id = '$id'");
                // Update player inventory
                $inventoryUpdate = [];
                foreach ($resultInventory as $key => $value) {
                    if ($key !== 'id') {
                        $inventoryUpdate[] = "`$key` = '$value'";
                    }
                }
                $inventoryUpdateQuery = implode(', ', $inventoryUpdate);
                $db->query("UPDATE playerInventory SET $inventoryUpdateQuery WHERE id = '$id'");
               
header("Location: ?page=profile");
exit;

            }
        }
    } elseif(isset($_POST['equip'])) {
        $itemId = $_POST['item_id'];
        // Find the first empty slot in player equipment to equip the item
        $emptySlot = array_search(0, $resultEquipment);
        if ($emptySlot !== false) {
            $resultEquipment[$emptySlot] = $itemId;
            // Find the slot in player inventory where the item is stored and set it to 0
            $slotIndex = array_search($itemId, $resultInventory);
            if ($slotIndex !== false) {
                $resultInventory[$slotIndex] = 0;
                // Update player equipment
                $equipmentUpdate = [];
                foreach ($resultEquipment as $key => $value) {
                    if ($key !== 'id') {
                        $equipmentUpdate[] = "`$key` = '$value'";
                    }
                }
                $equipmentUpdateQuery = implode(', ', $equipmentUpdate);
                $db->query("UPDATE playerEquipment SET $equipmentUpdateQuery WHERE id = '$id'");
                // Update player inventory
                $inventoryUpdate = [];
                foreach ($resultInventory as $key => $value) {
                    if ($key !== 'id') {
                        $inventoryUpdate[] = "`$key` = '$value'";
                    }
                }
                $inventoryUpdateQuery = implode(', ', $inventoryUpdate);
                $db->query("UPDATE playerInventory SET $inventoryUpdateQuery WHERE id = '$id'");
                               
header("Location: ?page=profile");
exit;

            }
        }
    }
}



?>

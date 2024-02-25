<?php
global $db;
$id = $_SESSION['loggedIn'];
$sql = "SELECT 
            stats.*, 
            users.username AS user_username,
            stats.level AS user_level,
            stats.xp AS user_xp,
            stats.money AS user_money,
            stats.health AS user_health,
            stats.maxhealth AS user_maxhealth,
            stats.energy AS user_energy,
            stats.maxenergy AS user_maxenergy,
            stats.strength AS user_strength,
            stats.accuracy AS user_accuracy,
            stats.intellect AS user_intellect,
            stats.crit AS user_crit,
            stats.statpoints AS user_statpoints,
            playerInventory.*, 
            playerEquipment.*,
            item.item_id, 
            item.name AS item_name, 
            item.strength AS item_strength,
            item.maxhealth AS item_maxhealth,
            item.maxenergy AS item_maxenergy,
            item.intellect AS item_intellect,
            item.health AS item_health,
            item.energy AS item_energy,
            item.defense AS item_defense,
            item.crit AS item_crit,
            item.accuracy AS item_accuracy,
            item.description AS item_description,
            item.image AS item_image,
            item.rarity AS item_rarity
        FROM 
            stats 
            INNER JOIN users ON stats.id = users.id 
            LEFT JOIN playerInventory ON stats.id = playerInventory.id
            LEFT JOIN playerEquipment ON stats.id = playerEquipment.id
            LEFT JOIN item ON (playerEquipment.slot_1 = item.item_id OR 
                               playerEquipment.slot_2 = item.item_id OR 
                               playerEquipment.slot_3 = item.item_id OR 
                               playerEquipment.slot_4 = item.item_id OR 
                               playerEquipment.slot_5 = item.item_id OR 
                               playerEquipment.slot_6 = item.item_id OR 
                               playerEquipment.slot_7 = item.item_id OR 
                               playerEquipment.slot_8 = item.item_id OR 
                               playerInventory.slot_1 = item.item_id OR 
                               playerInventory.slot_2 = item.item_id OR 
                               playerInventory.slot_3 = item.item_id OR 
                               playerInventory.slot_4 = item.item_id OR 
                               playerInventory.slot_5 = item.item_id OR 
                               playerInventory.slot_6 = item.item_id OR 
                               playerInventory.slot_7 = item.item_id OR 
                               playerInventory.slot_8 = item.item_id)  
        WHERE 
            stats.id='$id'";
$stmt = $db->query($sql);
$result = $stmt->fetchAll();

$equipment = [];
$inventory = [];

foreach ($result as $row) {
    for ($i = 1; $i <= 8; $i++) {
        $equipmentSlot = "slot_$i";
        if (!empty($row[$equipmentSlot])) {
            $equipment[$equipmentSlot] = $row[$equipmentSlot];
        }
        
        $inventorySlot = "slot_$i";
        if (!empty($row[$inventorySlot])) {
            $inventory[$inventorySlot] = $row[$inventorySlot];
        }
    }
}
?>

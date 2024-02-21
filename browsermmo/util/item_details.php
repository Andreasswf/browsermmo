<?php

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

?>
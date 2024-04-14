
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
                    

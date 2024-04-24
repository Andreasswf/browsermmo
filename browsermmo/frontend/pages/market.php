<?php
// Fetches the health and max_health values from the database
include "../util/login_check.php";
include "../util/equip_functions.php";

$message = ""; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['item1'])) {
        $itemId = 1;
    } elseif(isset($_POST['item2'])) {
        $itemId = 2;
    } elseif(isset($_POST['item3'])) {
        $itemId = 28;
    } elseif(isset($_POST['item4'])) {
        $itemId = 4;
    } elseif(isset($_POST['item5'])) {
        $itemId = 5;
    } elseif(isset($_POST['item6'])) {
        $itemId = 6;
    } elseif(isset($_POST['sell']) && in_array($_POST['item_slot'], AVAILABLE_SLOTS)) {
        $itemSlot = $_POST['item_slot'];
        $itemId = $resultInventory[$itemSlot];
        
        // Fetch item price from the 'item' table based on the item ID
        $sqlItemPrice = "SELECT price FROM item WHERE item_id = $itemId";
        $stmtItemPrice = $db->query($sqlItemPrice);
        $itemPriceResult = $stmtItemPrice->fetch(PDO::FETCH_ASSOC);
        $itemPrice = $itemPriceResult['price'];
        
        // Calculate 75% of the item price
        $salePrice = 0.75 * $itemPrice;

        // Add sale price to player's money
        $playerMoney += $salePrice;

        // Remove the item from the inventory
        $inventorySlot = array_search($itemId, $resultInventory);

        if ($inventorySlot !== false) {
            $resultInventory[$inventorySlot] = 0;

            // Update player money
            $db->query("UPDATE stats SET money = $playerMoney WHERE id = $id");
            $db->query("UPDATE playerInventory SET $itemSlot = 0 WHERE id = $id");

            // Message indicating the item sold
            $sqlItemName = "SELECT name FROM item WHERE item_id = $itemId";
            $stmtItemName = $db->query($sqlItemName);
            $itemNameResult = $stmtItemName->fetch(PDO::FETCH_ASSOC);
            $itemName = $itemNameResult['name'];
            $message = "Du sålde $itemName för $salePrice daggdroppar!";
        } else {
            $message = "Kunde inte hitta objektet i din väska!";
        }
    } else {
        $message = "Invalid request!";
    }
}

// Buying items logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['item1']) || isset($_POST['item2']) || isset($_POST['item3']) ||
       isset($_POST['item4']) || isset($_POST['item5']) || isset($_POST['item6']) ||
       isset($_POST['item7']) || isset($_POST['item8']) || isset($_POST['item9']) ||
       isset($_POST['item10']) || isset($_POST['item11']) || isset($_POST['item12'])) {
        
        // Logic for buying items
        // Fetch item price from the 'item' table based on the item ID
        if(isset($_POST['item1'])) {
            $itemId = 31;
        } elseif(isset($_POST['item2'])) {
            $itemId = 32;
        } elseif(isset($_POST['item3'])) {
            $itemId = 33;
        } elseif(isset($_POST['item4'])) {
            $itemId = 34;
        } elseif(isset($_POST['item5'])) {
            $itemId = 35;
        } elseif(isset($_POST['item6'])) {
            $itemId = 36;
        } elseif(isset($_POST['item7'])) {
            $itemId = 37; // Adjust item IDs accordingly
        } elseif(isset($_POST['item8'])) {
            $itemId = 38;
        } elseif(isset($_POST['item9'])) {
            $itemId = 39;
        } elseif(isset($_POST['item10'])) {
            $itemId = 40;
        } elseif(isset($_POST['item11'])) {
            $itemId = 41;
        } elseif(isset($_POST['item12'])) {
            $itemId = 42;
        }
        
        $sqlItemPrice = "SELECT price FROM item WHERE item_id = $itemId";
        $stmtItemPrice = $db->query($sqlItemPrice);
        $itemPriceResult = $stmtItemPrice->fetch(PDO::FETCH_ASSOC);
        $itemPrice = $itemPriceResult['price'];

        // Check if player has enough money
        if ($playerMoney >= $itemPrice) {
            // Check if player inventory has an empty slot
            $emptySlot = array_search(0, $resultInventory);
            if ($emptySlot !== false) {
                // Deduct the item price from the player's money
                $playerMoney -= $itemPrice;

                // Add the item corresponding to the button clicked to the first empty slot of the player's inventory
                $randomItemId = $itemId;

                $resultInventory[$emptySlot] = $randomItemId;

                // Update player money
                $db->query("UPDATE stats SET money = '$playerMoney' WHERE id = '$id'");
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
                $sqlItemName = "SELECT name FROM item WHERE item_id = $randomItemId";
                $stmtItemName = $db->query($sqlItemName);
                $itemNameResult = $stmtItemName->fetch(PDO::FETCH_ASSOC);
                $itemName = $itemNameResult['name'];

                $message = "Du köpte $itemName för $itemPrice daggdroppar!";
            } else {
                $message = "Du har ingen plats i din väska!";
            }
        } else {
            $message = "Du har inte tillräckligt med pengar!";
        }
    }
}

function getRarityClass($class) {
    switch ($class) {
        case 'rare':
            return 'rare-item-name';
        case 'super_rare':
            return 'super-rare-item-name';
        case 'epic':
            return 'epic-item-name';
        default:
            return 'common-item-name';
    }
}

function getItem($itemId) {
    global $db;

    $sql = "SELECT * FROM item WHERE item_id = $itemId";

    $stmt = $db->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function getSellableItems($resultInventory) {
    $sellableItems = [];

    foreach($resultInventory as $id => $item) {
        if(in_array($id, AVAILABLE_SLOTS)) {
            if($item != 0) {
                $itemDetails = getItem($item);
                $sellableItems[$id] = $itemDetails;
            }
        }
    }

    return $sellableItems;
}
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

    .big-text {
        font-size: 24px;
    }

    .message-box {
        margin-top: 20px;
        text-align: center;
    }

    .message-textbox {
        width: 300px;
        height: 50px;
        border: 1px solid #ccc;
        padding: 10px;
        margin-top: 10px;
    }
</style>
</head>
<body>

<div class="container2">
    <p class="big-text">Köp föremål</p>
    <form method="post" action="">
        <input type="submit" name="item1" value="Kvist"> <br> <i>+18 slemstyrka</i>. 800 daggdroppar. <br> 
        <input type="submit" name="item2" value="Platt sten"> <br> <i>+18 maxhälsa</i>. 800 daggdroppar. <br>
        <input type="submit" name="item3" value="Sur kåda"> <br> <i>+18 maxenergi</i>. 800 daggdroppar.<br>
        <input type="submit" name="item4" value="Kottemössa"> <br> <i>+15 intellekt</i>. 800 daggdroppar. <br>
        <input type="submit" name="item5" value="Slem på burk"> <br> <i>+20 smidighet</i>.  800 daggdroppar. <br>
        <input type="submit" name="item6" value="Vitmossa"> <br> <i>+18 kritisk träff</i>. 800 daggdroppar. <br>
        <input type="submit" name="item7" value="Vässad pinne"> <br> <i>+30 slemstyrka</i>. 3500 daggdroppar. <br>
        <input type="submit" name="item8" value="Kikare"> <br> <i>+30 pricksäkerhet</i>. 2500 daggdroppar. <br>
        <input type="submit" name="item9" value="Vitt skal"> <br> <i>+45 maxhälsa</i>. 5500 daggdroppar. <br>
        <input type="submit" name="item10" value="Rotbälte"> <br> <i>+30 kritisk träff</i>. 2500 daggdroppar. <br>
        <input type="submit" name="item11" value="Rund kula"> <br> <i>+30 smidighet</i>. 2500 daggdroppar. <br>
        <input type="submit" name="item12" value="Vass flinta"> <br> <i>+30 slemstyrka</i>. 7500 daggdroppar. <br>
    </form>
</div>

<div class="container2">
    <p class="big-text">Sälj föremål</p>

    <div>
        <?php foreach (getSellableItems($resultInventory) as $slot => $item): ?>
            <form method="post">
                <div>
                    <p>
                        <span class="<?= getRarityClass($item['rarity']) ?>">
                            <?= $item['name']; ?> 
                        </span>
                        <i>
                            (<?= $item['description']; ?>)
                        </i>
                        <br>
                        <form method='post'>
                            <input type='hidden' name='item_slot' value='<?=$slot?>'>
                            <input type='submit' name='sell' value='Sälj'>
                        </form>
                    </p>
                </div>
            </form>
        <?php endforeach; ?>

        <?php if (empty($resultInventory)): ?>
            <div><p class='normal-text'>Inget användarinventarium hittades.</p></div>
        <?php endif; ?>
    </div>

    <!-- Message Display Section -->
   
</div>
    <div class="text-box">
    
<?php echo $message; ?>
    </div>
    
</body>
</html>

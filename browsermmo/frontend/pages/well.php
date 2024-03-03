<?php
include "../util/login_check.php";
include "../util/equip_functions.php";

// Handle form submission
$message = ""; // Initialize the message variable
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['well'])) {
        // Check if player has enough money
        if ($playerMoney >= 1000) {
            // Check if player inventory has an empty slot
            $emptySlot = array_search(0, $resultInventory);
            if ($emptySlot !== false) {
                // Deduct 1000 money from the player
                $playerMoney -= 1000;
                
                // Add 1 random item with an id from 1-5 to the first empty slot of the player's inventory
                $randomItemId = mt_rand(21, 27);
                
                // Fetch item name from the 'item' table based on the random item ID
                $sqlItemName = "SELECT name FROM item WHERE item_id = $randomItemId";
                $stmtItemName = $db->query($sqlItemName);
                $itemNameResult = $stmtItemName->fetch(PDO::FETCH_ASSOC);
                $itemName = $itemNameResult['name'];
                
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
                $message = "Du slängde ner dina daggdroppar. Efter några sekunder började vattnet i brunnen bubbla. $itemName sköljdes fram!";
            } else {
                $message = "Du har ingen plats i din väska för $itemName!";
            }
        } else {
            $message = "Du har inte tillräckligt med pengar!";
        }
    } elseif(isset($_POST['remove'])) {
        // Existing code for removing item from equipment to inventory
    } elseif(isset($_POST['equip'])) {
        // Existing code for equipping item from inventory to equipment
    } elseif(isset($_POST['toss'])) {
        // Existing code for tossing item from inventory
    }
}
?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Center Text Box</title>

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .text-box {
        width: 300px;
        border: 2px solid black;
        background-color: white;
        padding: 10px;
        margin: auto; /* Center horizontally */
        text-align: left; /* Center text within the box */
    }

    .big-text {
        font-size: 24px;
    }
</style>
</head>
<body>

        
   
    
<div class="text-box">
    <p class="big-text">Den magiska brunnen</p>

    Du har anlänt till den magiska brunnen. <br> <br>Är du beredd att offra dina hårt förtjänta daggdroppar för chansen att finna ett magiskt föremål? <br> <br>
    <form method="post">
        <input type="submit" name="well" value="Släng daggdroppar i brunnen"> <br> Kostar 1000 daggdropppar.
    </form>
</div>

<div id="centeredImage">
    <img src="https://i.postimg.cc/DzdbrNrj/db1a7d88-43a5-46d8-b1ab-5e9c715c8a93.jpg" alt="Centered Image">
</div>

    <?php echo $message; ?> <!-- Display message here -->

</body>
</html>

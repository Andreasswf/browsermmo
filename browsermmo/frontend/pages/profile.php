<?php
// Include the login check script or any other necessary scripts to fetch user data like stats etc
include "../util/login_check.php";

// Assuming the database connection is established and $db variable is available
global $db;
$id = $_SESSION['loggedIn'];

// Fetch player equipment
$sqlEquipment = "SELECT * FROM playerEquipment WHERE id = '$id'";
$stmtEquipment = $db->query($sqlEquipment);
$resultEquipment = $stmtEquipment->fetch();

// Fetch player inventory
$sqlInventory = "SELECT * FROM playerInventory WHERE id = '$id'";
$stmtInventory = $db->query($sqlInventory);
$resultInventory = $stmtInventory->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .container {
            width: 200px;
            padding: 20px;
            border: 2px solid black;
            background-color: white;
            text-align: center;
            margin: 0 10px;
        }

        .bold-text {
            font-weight: bold;
            font-size: 24px;
            text-align: center;
        }

        .normal-text {
            text-align: center;
        }

        .flex-container {
            display: flex;
            justify-content: center;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>

<div class="flex-container">
    <div class="container">
        <?php if(!empty($result)): ?>
        <p class="bold-text"><?php echo $result[0]['user_username']; ?> </p>
        <p class="normal-text">Level:  <?php echo $result[0]['user_level']; ?> </p> 
        <p class="normal-text">XP:  <?php echo $result[0]['user_xp']; ?> </p>
        <p class="normal-text">Daggdroppar:  <?php echo $result[0]['user_money']; ?> </p>
        <p class="normal-text">Hälsa:  <?php echo $result[0]['user_health']; ?> / <?php echo $result[0]['user_maxhealth']; ?> </p>
        <p class="normal-text">Energi:  <?php echo $result[0]['user_energy']; ?> / <?php echo $result[0]['user_maxenergy']; ?> </p>
        <p class="normal-text">Slemstyrka:  <?php echo $result[0]['user_strength']; ?> </p>
        <p class="normal-text">Pricksäkerhet:  <?php echo $result[0]['user_accuracy']; ?> </p>
        <p class="normal-text">Intellekt:  <?php echo $result[0]['user_intellect']; ?> </p>
        <p class="normal-text">Kritisk träff:  <?php echo $result[0]['user_crit']; ?> </p>
        <?php else: ?>
        <p>No user data found.</p>
        <?php endif; ?>
    </div>

    <div class="container">
        <p class="bold-text">Utrustning: </p>
        <ul>
            <?php
            if (!empty($resultEquipment)) {
                for ($i = 1; $i <= 8; $i++) {
                    $equipmentSlot = "slot_$i";
                    $itemId = $resultEquipment[$equipmentSlot];
                    if (!empty($itemId)) {
                        // Fetch item details from the 'item' table based on item_id
                        $sqlItem = "SELECT name, description FROM item WHERE item_id = $itemId";
                        $stmtItem = $db->query($sqlItem);
                        $itemResult = $stmtItem->fetch();
                        $itemName = $itemResult ? $itemResult['name'] : "ledig plats";
                        $itemDescription = $itemResult ? $itemResult['description'] : "";
                        echo "<li>$itemName <br> <i>$itemDescription</i></li>";
                    } else {
                        echo "<li>ledig plats</li>";
                    }
                }
            } else {
                echo "<li>No user equipment found.</li>";
            }
            ?>
        </ul>
    </div>

    <div class="container">
        <p class="bold-text">Föremål i väskan: </p>
        <ul>
            <?php
            if (!empty($resultInventory)) {
                for ($i = 1; $i <= 8; $i++) {
                    $inventorySlot = "slot_$i";
                    $itemId = $resultInventory[$inventorySlot];
                    if (!empty($itemId)) {
                        // Fetch item details from the 'item' table based on item_id
                        $sqlItem = "SELECT name, description FROM item WHERE item_id = $itemId";
                        $stmtItem = $db->query($sqlItem);
                        $itemResult = $stmtItem->fetch();
                        $itemName = $itemResult ? $itemResult['name'] : "ledig plats";
                        $itemDescription = $itemResult ? $itemResult['description'] : "";
                        echo "<li>$itemName <br> <i>$itemDescription</i></li>";
                    } else {
                        echo "<li>ledig plats</li>";
                    }
                }
            } else {
                echo "<li>No user inventory found.</li>";
            }
            ?>
        </ul>
    </div>

    <div class="clearfix"></div> <!-- Add clearfix to prevent container overlap -->
</div>

</body>
</html>

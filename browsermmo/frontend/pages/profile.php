<?php
// Include the login check script or any other necessary scripts to fetch user data like stats etc
include "../util/login_check.php";



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
        <p class="bold-text"><?php echo $result[0]['username']; ?> </p>
        <p class="normal-text">Level:  <?php echo $result[0]['level']; ?> </p> 
        <p class="normal-text">XP:  <?php echo $result[0]['xp']; ?> </p>
        <p class="normal-text">Daggdroppar:  <?php echo $result[0]['money']; ?> </p>
        <p class="normal-text">Hälsa:  <?php echo $result[0]['health']; ?> / <?php echo $result[0]['maxhealth']; ?> </p>
        <p class="normal-text">Energi:  <?php echo $result[0]['energy']; ?> / <?php echo $result[0]['maxenergy']; ?> </p>
        <p class="normal-text">Slemstyrka:  <?php echo $result[0]['strength']; ?> </p>
        <p class="normal-text">Pricksäkerhet:  <?php echo $result[0]['accuracy']; ?> </p>
        <p class="normal-text">Intellekt:  <?php echo $result[0]['intellect']; ?> </p>
        <p class="normal-text">Kritisk träff:  <?php echo $result[0]['crit']; ?> </p>
    </div>
    
    <div class="container">
        <p class="bold-text">Utrustning: </p>
  
        
            <?php
    // Display the first item
    echo "<p class='normal-text'>" . $result[0]['item_name']. "</p>";
    echo "<p class='normal-text'><i>" . $result[0]['item_description'] . "</i></p>";
    // Add a button for the first item
    echo '<a href="?page=profile&action=equip&"><button>Ta av</button></a>';
    
    // Display additional item slots (Föremål 2 to Föremål 8) with a button
    for ($i = 2; $i <= 8; $i++) {
        echo "<p class='normal-text'>Föremål $i</p>";
        // Add a button next to each item
        echo '<a href="?page=profile"><button>Ta av</button></a>';
    }
    ?>
    </div>

    
    

<div class="container">
    <p class="bold-text">Föremål i väskan: </p>
    <?php
    // Initialize an array to store items by their slot_id
    $itemsBySlot = [];

    // Organize items by their slot_id
    foreach ($result as $item) {
        $slotId = $item['slot_id'];
        if (!isset($itemsBySlot[$slotId])) {
            $itemsBySlot[$slotId] = [];
        }
        $itemsBySlot[$slotId][] = [
            'name' => $item['item_name'],
            'description' => $item['item_description']
        ];
    }

    // Display items in their respective order
    for ($i = 1; $i <= 8; $i++) {
        if (isset($itemsBySlot[$i])) {
            foreach ($itemsBySlot[$i] as $item) {
                echo "<p class='normal-text'>{$item['name']}</p>";
                echo "<p class='normal-text'><i>{$item['description']}</i></p>";
                echo "<a href='?page=profile&action=equip&'><button>Utrusta</button></a>";
            }
        }
    }
    ?>
</div>


    
</div>

<div class="clearfix"></div> <!-- Add clearfix to prevent container overlap -->

</body>
</html>

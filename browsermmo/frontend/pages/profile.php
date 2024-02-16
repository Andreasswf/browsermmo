<?php
// Include the login check script or any other necessary scripts to fetch user data
include "../util/login_check.php";

// Assuming $result is populated with user stats elsewhere in your code
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
        <?php /* Add PHP code here to display user's equipment */ ?>
    </div>

    
    

    
    <div class="container">
        <p class="bold-text">Föremål i väskan: </p>
        <?php
        // Display the item name retrieved from the query
        echo "<p class='normal-text'>" . $result[0]['item_name'] . "</p>";
        
        // Placeholder for additional item slots (Föremål 2 to Föremål 8)
        for ($i = 2; $i <= 8; $i++) {
            echo "<p class='normal-text'>Föremål $i</p>";
        }
        ?>
    </div>
</div>

<div class="clearfix"></div> <!-- Add clearfix to prevent container overlap -->

</body>
</html>

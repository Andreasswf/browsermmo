<?php

include "../util/login_check.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.container {
    width: 200px; /* Set a fixed width for each container */
    padding: 20px;
    border: 2px solid black;
    background-color: white;
    text-align: center; /* Center the content inside the container */
    margin: 0 10px; /* Add margin to create spacing between containers */
}

.bold-text {
    font-weight: bold;
    font-size: 24px;
    text-align: center; /* Center the text */
}

.normal-text {
    text-align: center; /* Center the text */
}

/* Flex container for equal-sized containers */
.flex-container {
    display: flex;
    justify-content: center; /* Center the items horizontally */
}

/* Clearfix to prevent container overlap */
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
        <p class="normal-text">Intellekt:  <?php echo $result[0]['defense']; ?> </p>
        <p class="normal-text">Kritisk träff:  <?php echo $result[0]['crit']; ?> </p>
    </div>
    
    <div class="container">
        <p class="bold-text">Utrustning: </p>
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p>
    </div>

    <div class="container">
        <p class="bold-text">Föremål i väskan: </p>
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p> 
        <p class="normal-text">Tomt </p>
    </div>
</div>

<div class="clearfix"></div> <!-- Add clearfix to prevent container overlap -->

</body>
</html>

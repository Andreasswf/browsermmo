<?php


include "../util/login_check.php";
include "../util/equip_functions.php";

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
    <button id="wellButton">Offra dagdroppar</button> (Kostar 1000 daggdroppar / föremål). <br>
    
</div>

<div id="centeredImage">
    <img src="https://i.postimg.cc/DzdbrNrj/db1a7d88-43a5-46d8-b1ab-5e9c715c8a93.jpg" alt="Centered Image">
</div>


</body>
</html>

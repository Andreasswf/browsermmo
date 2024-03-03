<?php
include "../util/login_check.php";
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
    <p class="big-text">Välkommen till skogen!</p>
    En tät urskog fylld av mosstäckta stenar och sublima träd. <br> <br> Här kan du bl.a. stöta på andra spelare, gå på monsterjakt och besöka den magiska brunnen. <br> <br>
    <i> Det sägs att djupt inne i skogen finns uråldriga monster som bär på magiska skatter... <i> <br> <br>
    <button id="fightButton">Gå på monsterjakt!</button> (Kostar 1 energi). <br>
    <a href="?page=well"><button>Den magiska brunnen</button></a> (1000 daggdroppar för att generera ett slumpat föremål).
</div>

<div id="centeredImage">
    <img src="https://i.postimg.cc/Z5sw-rnxD/54b42c08-c8c1-41d1-a3c0-586caa8cca3b.jpg" alt="Centered Image">
</div>

<script>
    document.getElementById("fightButton").addEventListener("click", function() {
        // Check if energy is sufficient
        <?php if ($result[0]['energy'] > 0) { ?>
            // If energy is more than 0, proceed with the fight
            <?php
            // Set monsterDifficulty session variable to 1
            $_SESSION['monsterDifficulty'] = 1;
            ?>
            window.location.href = "?page=combat_test";
        <?php } else { ?>
            // If energy is 0 or less, show error message
            alert("Du har för lite energi!");
        <?php } ?>
    });
</script>

</body>
</html>

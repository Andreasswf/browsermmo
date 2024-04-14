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
    <p class="big-text">Välkommen till sjön!</p>
    En spegelblank sjö som gränsar till skogen. Här finns även en sandstrand med några enstaka hala stenar. <br> <br> Här kan du bl.a. stöta på andra spelare och gå på monsterjakt vid vattnet! <br> <br> Kanske finns det några hemliga platser att upptäcka? <br> <br>
    <i> Det sägs att djupt nere på sjöns botten finns uråldriga monster som bär på magiska skatter... <i> <br> <br>
    <button id="fightButton">Gå på monsterjakt!</button> (Kostar 2 energi). <br>
   
</div>

<div id="centeredImage">
    <img src="https://i.postimg.cc/mhx8LG7P/21c89465-d7b1-47e9-9671-15f8b6c3a715.jpg" alt="Centered Image">
</div>

<script>
    document.getElementById("fightButton").addEventListener("click", function() {
        // Check if energy is sufficient
        <?php if ($result[0]['energy'] > 1) { ?>
            // If energy is more than 2, proceed with the fight
            <?php
            
            // Set monsterDifficulty session variable to 1
            $_SESSION['monsterDifficulty'] = 1;
                    $new_energy = $playerEnergy - 2;
        $sql_update_energy = "UPDATE stats SET energy = $new_energy, lastenergyupdate=NOW() WHERE id = $id";
        $db->query($sql_update_energy);
        $playerEnergy = $new_energy;
            ?>
            window.location.href = "?page=combat_lake";
        <?php } else { ?>
            // If energy is 1 or less, show error message
            alert("Du har för lite energi!");
        <?php } ?>
    });
</script>

</body>
</html>

<?php 
if(isset($_GET['message'])){
    echo $_GET['message'] . "<br>";
}

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


</style>
</head>
<body>

<div class="text-box">
    <p class="big-text">Gå på snigeläventyr!</p>
    <a href="?page=forest"><button>Skogen</button></a> <br> <br>
    <button id="lakeButton">Sjön</button> (Kräver nivå 10). <br>
    <p><b>Bondgården</b> (nivå 20)</p>
    <p><b>Grottan</b> (nivå 30)</p>
    <p><b>Träsket</b> (nivå 40)</p>
</div>

                <div id="centeredImage">
                <img src="https://i.postimg.cc/90jc2TJD/724ad136-46ef-43f8-806d-01a6387fc8ed.jpg" alt="Centered Image">
            </div>
    
    <script>
    document.getElementById("lakeButton").addEventListener("click", function() {
        // Check if level is sufficient
        <?php if ($result[0]['level'] > 9) { ?>
            // If level is more than 9, proceed with going to lake page

            window.location.href = "?page=lake";
        <?php } else { ?>
            // If level is 9 or less, show error message
            alert("Du är för låg nivå!");
        <?php } ?>
    });
</script>
    
    
</body>
</html>

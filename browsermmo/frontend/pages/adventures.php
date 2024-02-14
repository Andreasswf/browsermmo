<?php 
if(isset($_GET['message'])){
    echo $_GET['message'] . "<br>";
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
        text-align: center; /* Center text within the box */
    }

    .big-text {
        font-size: 24px;
    }
</style>
</head>
<body>

<div class="text-box">
    <p class="big-text">Gå på snigeläventyr!</p>
    <a href="?page=forest"><button>Skogen</button></a>
    <p><b>Sjön</b> (level 20)</p>
    <p><b>Bondgården</b> (level 30)</p>
    <p><b>Grottan</b> (level 40)</p>
    <p><b>Träsket</b> (level 50)</p>
</div>

                <div id="centeredImage">
                <img src="https://i.postimg.cc/90jc2TJD/724ad136-46ef-43f8-806d-01a6387fc8ed.jpg" alt="Centered Image">
            </div>
    
</body>
</html>

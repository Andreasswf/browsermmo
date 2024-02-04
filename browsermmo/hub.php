<!DOCTYPE html>
<html lang="en">

    
      <?php
      include ("design/templates/head.php");
    ?>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SnigelKraft</title>
    <style>
        body {
            display: flex;
            justify-content: start;
            align-items: center;
            flex-direction: column; /* Align content vertically */
            height: 100vh;
            margin: 0;
            background-color: tan; /* Set the background color of the body */
        }
        
.banner {
    border: 2px black solid;
    width: 35.5%;
    height: 5%;
    margin-top: 20px;
    }
    
    .profilepicture {
    border: 2px black solid;
    width: 15%;
    height: 15%;
    margin-top: 20px;
    align-items: center;
    
    }
    </style>

<body>
    <div class="banner">
        &nbsp;<span class="b1">Profil•</span> 
        &nbsp; <span class="b1">Äventyr•</span>
        &nbsp; <span class="b1">Snigelshoppen•</span>
        &nbsp; <span class="b1">Info•</span>
    </div>
    
    <span class="character_name_text">ANVÄNDARNAMN</span>
 
    <div class="profilepicture">
        Din profilbild här
    </div>
         
        <div class="character-info">
        <p>
            Art: </br>
            <span class="hälsa_text"> Hälsa:</span> </br>
           <span class="energi_text">Energi:</span> </br>
           <span class="slem_text">Slemstyrka:</span>       
        </p>
        
    </div>
         
    
</body>
</html> 
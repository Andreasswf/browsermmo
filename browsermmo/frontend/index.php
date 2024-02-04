<!DOCTYPE html>
<html lang="en">
       <?php
      include ("design/templates/head.php");
    ?>
         <div id="wrapper">
            <?php 
                include("design/templates/top.php");
            ?>
            <div id="main">
                        <p>
            Välkommen till <b>SnigelKraft.se</b>! <br /> Ett textbaserat MMORPG där du, tillsammans med andra sniglar, glider ut på spännande äventyr i naturen!
        </p>
            
            <div id="accountOptions">
        <a href="?page=register">Ny snigel</a><br>
        <a href="?page=login">Logga in</a>
    </div>
                
       
    </style>
<body>
    <div id="centeredImage">
        <img src="https://skadedjursbutiken.se/wp-content/uploads/2021/07/leopardsnigel.jpg" alt="Centered Image">
    </div>
</body>
                <?php
    
                if (isset($_GET['page'])){
                    if ($_GET['page'] === "register"){
                        include("pages/register.php");
                    }
                    elseif($_GET['page'] === "login"){
                        include("pages/login.php");
                    }
                    else{
                        echo "You requested an invalid link";
                    }
                               
                } else { include("pages/login.php");
                }
                ?>
            </div>
            <?php 
                include("design/templates/footer.php");
            ?>
        </div>
 
</html>
  
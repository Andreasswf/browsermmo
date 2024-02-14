<?php
    if(isset($_SESSION['loggedIn'])){
?>
    <div id="top">
        <h1 class="large noMargin center">SnigelKraft.se</h1>
        <div id="accountOptions" class="center" >
            <a href="?page=profile"><button>Din snigel</button></a>
            <a href="?page=adventures"><button>Äventyr</button></a>
            <a href="?bPage=accountOptions&action=logout&nonUI"><button>Snigelshoppen</button></a>
            <a href="?page=news"><button>Nyheter</button></a>
            <a href="?page=news"><button>Topplistan</button></a>
            <a href="?bPage=accountOptions&action=logout&nonUI"><button>Logga ut</button></a>
        </div>
    </div>
<?php
    }
    else{
        ?>
        <div id="top">
            <h1 class="large noMargin center">SnigelKraft.se</h1>
            <div id="accountOptions" class="floatRight" >
             
            </div>
        </div>
    <?php
    }
?>
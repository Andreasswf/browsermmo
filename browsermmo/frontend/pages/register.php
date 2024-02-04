<?php
    if(isset($_GET['message'])){
        echo $_GET['message'] . "<br>";
    }
?>

Registrera ny snigel:

<form action="?bPage=accountOptions&action=register&nonUI" method="post">
    Användarnamn:<br> <input type="text" name="username"><br>
    Lösenord:<br> <input type="password" name="password"><br>
    E-post:<br> <input type="email" name="email"><br> 
    <input type="submit">
</form>
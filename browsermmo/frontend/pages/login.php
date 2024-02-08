<?php
    if(isset($_GET['message'])){
        echo $_GET['message'] . "<br>";
    }
?>
Logga in:

<form action="?bPage=accountOptions&action=login&nonUI" method="post">
    Användarnamn:<br> <input type="text" name="username"><br>
    Lösenord:<br> <input type="password" name="password"><br>
    <input type="submit">
</form>
<?php
    if(isset($_GET['message'])){
        echo $_GET['message'] . "<br>";
    }
?>

Skapa ny snigel:

<form action="?bPage=accountOptions&action=register&nonUI" method="post">
    Användarnamn:<br> <input type="text" name="username" pattern=".{4,20}" title="minst 4 bokstäver, max 20" required><br>
    Lösenord:<br> <input type="password" name="password" pattern=".{8,32}" title="minst 8 bokstäver, max 32" required><br>
    E-post:<br> <input type="email" name="email" required><br> 
    <input type="submit">
</form>



<?php

function registerAccount($username, $password, $email){
    global $db;
    if(preg_match("/^[a-zA-Z0-9]+$/", $username) !== 0){
        if (strlen($username) >= 4 && strlen($username) <= 20) {
            $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
            $sql = "INSERT INTO users (username,password,email) VALUES(?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($username, $hash, $email));
            if ($stmt->rowCount() > 0){
                // Get the ID of the last inserted user
                $user_id = $db->lastInsertId();
                
                // Insert into stats table
                $stats_sql = "INSERT INTO stats (id, level, xp, money, health, energy, strength, accuracy, defense, intellect, crit, maxhealth, maxenergy) VALUES (?,1,0,10,10,10,10,10,10,10,10,10,10)";
$stats_stmt = $db->prepare($stats_sql);
$stats_stmt->execute(array($user_id)); // Corrected to match the number of placeholders

  


                $_SESSION['loggedIn'] = $user_id;
                header("location: ?page=loggedIn&message=Registrerad och inloggad!");
            }
            else{
                header("location: ?page=register&message=misslyckad%20registrering.");
            }
        }
        else{
            header("location: ?page=register&message=För%20långt%20eller%20för%20kort%20namn!");
        }
    }
    else{
        header("location: ?page=register&message=Använd%20ej%20konstiga%20symboler!");
    }
}

function login($username,$password){
    global $db;
    
    $sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':username' => $username));
    if ($stmt->rowCount() > 0){
        $result = $stmt->fetchAll();
        $hash = $result[0]['password'];
        if(password_verify($password, $hash)){
            $_SESSION['loggedIn'] = $result[0]['id'];
            header("location: ?page=loggedIn&message=Du%20har%20loggat%20in!");
        }
    }
    else{
        #user not found / password incorrect
        header("location: ?page=register&message=Fel%20namn%20eller%20lösenord!");
    }
}

function logout(){
    session_destroy();
    header("location: ?");
}



if($_GET['action'] === "register"){
    registerAccount($_POST['username'],$_POST['password'],$_POST['email']);
}
elseif($_GET['action'] === "login"){
    login($_POST['username'],$_POST['password']);
}
elseif($_GET['action'] === "logout"){
    logout();
}



?>
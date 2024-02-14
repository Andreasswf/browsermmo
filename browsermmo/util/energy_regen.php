<?php

global $db;
$id = $_SESSION['loggedIn'];
$sql = "SELECT * FROM stats 
               WHERE id='$id'";
$stmt = $db->query($sql);
$result = $stmt->fetchAll();

/*echo "<pre>";
var_dump($result);
echo "</pre>";
die;
*/ 

//echo $result[0]['lastenergyupdate'];

$lastEnergyUpdated = strtotime($result[0]["lastenergyupdate"]);
$currentTimestamp = time();
$differenceInSeconds = $currentTimestamp - $lastEnergyUpdated;
$differenceInMinutes = floor ($differenceInSeconds/60);

$energyRegen = 0;
if($result[0]["energy"] + $differenceInMinutes >= $result[0]["maxenergy"]) {
 $energyRegen = $result[0]["maxenergy"];
} else {
 $energyRegen = $result[0]["energy"] + $differenceInMinutes;
}

if($energyRegen > 0) {

    $sql_update_energy = "UPDATE stats SET energy = $energyRegen, lastenergyupdate=NOW() WHERE id = $id";
                $db->query($sql_update_energy);
    
}
?>



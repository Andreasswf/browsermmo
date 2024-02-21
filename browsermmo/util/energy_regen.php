<?php

include "../util/login_check.php";
include "../util/equip_functions.php";


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
if($playerEnergy + $differenceInMinutes >= $totalMaxEnergy) {
 $energyRegen = $totalMaxEnergy;
} else {
 $energyRegen = $playerEnergy + $differenceInMinutes;
}

if($energyRegen > 0) {

    $sql_update_energy = "UPDATE stats SET energy = $energyRegen, lastenergyupdate=NOW() WHERE id = $id";
                $db->query($sql_update_energy);
    
}
?>



<?php
include "../util/login_check.php";
include "../util/equip_functions.php";

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data
    $id = $_POST['user_id'];
    $totalStatPoints = $_POST['total_statpoints'];
    $maxHealth = $_POST['maxhealth'];
    $maxEnergy = $_POST['maxenergy'];
    $strength = $_POST['strength'];
    $accuracy = $_POST['accuracy'];
    $defense = $_POST['defense'];
    $intellect = $_POST['intellect'];
    $crit = $_POST['crit'];

    // Calculate total allocated points
    $totalAllocatedPoints = $maxHealth + $maxEnergy + $strength + $accuracy + $defense + $intellect + $crit;

    // Ensure the total allocated points don't exceed available points
    if($totalAllocatedPoints <= $totalStatPoints) {
        // Update user's stats in the database
        $sql = "UPDATE stats 
                SET maxhealth = maxhealth + ?, 
                    maxenergy = maxenergy + ?, 
                    strength = strength + ?, 
                    accuracy = accuracy + ?,
                    defense = defense + ?,
                    intellect = intellect + ?, 
                    crit = crit + ? 
                WHERE id = $id";
        $stmt = $db->prepare($sql);
        $stmt->execute([$maxHealth, $maxEnergy, $strength, $accuracy, $defense, $intellect, $crit]);

        // Update user's remaining stat points
        $remainingStatPoints = $totalStatPoints - $totalAllocatedPoints;
        $sqlUpdateStatPoints = "UPDATE stats SET statpoints = ? WHERE id = $id";
        $stmtUpdateStatPoints = $db->prepare($sqlUpdateStatPoints);
        $stmtUpdateStatPoints->execute([$remainingStatPoints]);
        
        // Redirect or display a success message
        header("Location: ?page=profile");
        // exit;
        $resultMessage = "Stats updated successfully!";
    } else {
        $resultMessage = "You cannot allocate more points than available stat points.";
    }
}
?>

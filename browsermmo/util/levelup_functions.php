    <?php
// Function to calculate required XP based on current level
function calculateRequiredXP($playerLevel) {
    $requiredXP = pow(2, $playerLevel - 1) * 50; // Adjust the multiplier and base XP as needed
    return $requiredXP;
}

// Example usage:

$requiredXP = calculateRequiredXP($playerLevel);

?>
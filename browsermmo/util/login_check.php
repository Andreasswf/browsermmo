<?php 

// Assuming $db is your database connection
global $db;

// Fetch the user's ID from the session
$id = $_SESSION['loggedIn'];

// SQL query to retrieve user stats, inventory items, and item details
$sql = "SELECT 
            stats.*, 
            users.username, 
            playerInventory.*, 
            item.id AS item_id, 
            item.name AS item_name, 
            item.description AS item_description, 
            item.image AS item_image
        FROM 
            stats 
        INNER JOIN 
            users ON stats.id = users.id 
        LEFT JOIN 
            playerInventory ON users.id = playerInventory.user_id
        LEFT JOIN 
            item ON playerInventory.item_id = item.id
        WHERE 
            stats.id = :id";

// Prepare the SQL statement
$stmt = $db->prepare($sql);

// Bind the parameter
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Execute the query
$stmt->execute();

// Fetch the result as an associative array
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Dump the contents of $result for debugging
// var_dump($result);




//$_SESSION ['money'] = $result [0]

       /*echo "<pre>";
var_dump($result);
echo "</pre>";
die;*/
        
?>
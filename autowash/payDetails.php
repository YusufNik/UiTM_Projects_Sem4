<?php
include("dbconn.php");

// Initialize the $json array
$json = array();

// Get valeus from POST
$bookID = $_POST['b_id'];

// Create SQL statement to retrieve data from the customer table
$sql = "SELECT payMethod, payBankName, payAccNum FROM payment WHERE bookID = '$bookID'";

// Execute the SQL statement
$res = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));

// Fetch each row and add it to the $json array
while ($r = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    $json[] = $r;
}

// Encode the $json array to JSON format and echo it
echo json_encode($json, JSON_UNESCAPED_UNICODE);

// Free the result set
mysqli_free_result($res);

// Close the database connection
mysqli_close($dbconn);
?>

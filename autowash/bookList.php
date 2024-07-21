<?php
include("dbconn.php");

$username = $_POST['c_username'];

// Initialize the $json array
$json = array();

// Create SQL statement to retrieve data from the booking table
$sql = "SELECT * FROM booking WHERE custUsername='$username'";

// Execute the SQL statement
$res = mysqli_query($dbconn, $sql) or die(json_encode(['error' => mysqli_error($dbconn)]));

// Fetch each row and add it to the $json array
while ($r = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    $json[] = $r;
}

// Free the result set
mysqli_free_result($res);

// Close the database connection
mysqli_close($dbconn);

// Encode the $json array to JSON format and echo it, or echo 'none' if no data found
if (!empty($json)) {
    echo json_encode($json, JSON_UNESCAPED_UNICODE);
} else {
    echo 'none';
}
?>

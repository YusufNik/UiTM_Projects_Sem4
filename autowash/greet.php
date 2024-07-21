<?php
// Start the session
session_start();

// Include the database connection file
include("dbconn.php");

// Get the username from the POST request
$username = $_POST['c_username'];

// SQL query to find the customer's name based on the username
$sql = "SELECT custName FROM Customer WHERE custUsername = '$username'";
$result = mysqli_query($dbconn, $sql);

// Check if a customer with the provided username exists
if (mysqli_num_rows($result) > 0) {
    // Fetch the customer's name
    $customer = mysqli_fetch_assoc($result);
    $custName = $customer['custName'];

    // Echo the customer's name
    echo $custName;
} else {
    // Echo guest if no customer found
    echo "Guest";
}
?>

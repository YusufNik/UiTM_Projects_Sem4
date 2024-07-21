<?php
// Start the session
session_start();

/* include db connection file */
include("dbconn.php");

// Accept these data from MIT interface
$username = $_POST['c_username'];
$password = $_POST['c_password'];

// SQL to check for matching username and password
$sql = "SELECT * FROM Customer WHERE custUsername = '$username' AND custPassword = '$password'";
$result = mysqli_query($dbconn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Fetch the customer data
    $customer = mysqli_fetch_assoc($result);

    // Respond with success
    echo "success";
} else {
    // Respond with fail
    echo "fail";
}
?>

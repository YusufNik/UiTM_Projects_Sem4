<?php
/* include db connection file */
include("dbconn.php");

// Accept these data from MIT interface
$username = $_POST['c_username'];
$name = $_POST['c_name'];
$number = $_POST['c_num'];
$password = $_POST['c_password'];

// Check if username already exists
$sql_check = "SELECT * FROM Customer WHERE custUsername = '$username'";
$result_check = mysqli_query($dbconn, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    // Username already exists
    echo "exist";
} else {
    // Insert the new customer into the database
    $sql_insert = "INSERT INTO Customer (custName, custNum, custUsername, custPassword) VALUES ('" . $name . "', '" . $number . "', '" . $username . "', '" . $password . "')";
    if (mysqli_query($dbconn, $sql_insert)) {
        // Successfully inserted
        echo "success";
    } else {
        // Error inserting
        echo "error";
    }
}
?>

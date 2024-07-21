<?php
/* include db connection file */
include("dbconn.php");

// Accept these data from MIT interface
$username = $_POST['c_username'];
$name = $_POST['c_name'];
$number = $_POST['c_num'];
$password = $_POST['c_password'];

// Prepare the SQL query to update the customer's details
$sql = "UPDATE customer SET custName = ?, custNum = ?, custPassword = ? WHERE custUsername = ?";

// Initialize a statement
$stmt = mysqli_prepare($dbconn, $sql);

// Bind parameters to the statement
mysqli_stmt_bind_param($stmt, "ssss", $name, $number, $password, $username);

// Execute the statement and handle errors
if (mysqli_stmt_execute($stmt)) {
    echo "Customer details have been updated successfully.";
} else {
    die("Error: " . mysqli_error($dbconn));
}

// Close the statement and the database connection
mysqli_stmt_close($stmt);
mysqli_close($dbconn);
?>

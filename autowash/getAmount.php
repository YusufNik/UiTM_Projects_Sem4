<?php
// Start the session
session_start();

// Include the database connection file
include("dbconn.php");

// Get the values from the POST request
$bookID = $_POST['b_id'];

// Function to get the amount value based on bookID
function getBookingAmount($dbconn, $bookID) {
    // Prepare the SQL query
    $sql = "SELECT bookAmount FROM booking WHERE bookID = ?";
    
    // Initialize a statement
    $stmt = mysqli_prepare($dbconn, $sql);
    
    // Bind the bookID to the statement
    mysqli_stmt_bind_param($stmt, "s", $bookID);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Bind the result variable
    mysqli_stmt_bind_result($stmt, $bookAmount);
    
    // Fetch the value
    mysqli_stmt_fetch($stmt);
    
    // Close the statement
    mysqli_stmt_close($stmt);
    
    // Return the amount
    return $bookAmount;
}

// Get the booking amount
$amount = getBookingAmount($dbconn, $bookID);

// Echo the amount
echo $amount;

// Close the database connection
mysqli_close($dbconn);
?>

<?php
// Start the session
session_start();

// Include the database connection file
include("dbconn.php");

// Get the values from the POST request
$bookID = $_POST['b_id'];

// Function to delete the row in the database which has the bookID
function deleteBooking($dbconn, $bookID) {
    // Prepare the SQL query
    $sql = "DELETE FROM booking WHERE bookID = ?";
    
    // Initialize a statement
    $stmt = mysqli_prepare($dbconn, $sql);
    
    // Bind the bookID to the statement
    mysqli_stmt_bind_param($stmt, "s", $bookID);
    
    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        //echo "delete";
    } else {
        //echo "error";
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);
}

// Call the function to delete the booking
deleteBooking($dbconn, $bookID);

// Close the database connection
mysqli_close($dbconn);
?>

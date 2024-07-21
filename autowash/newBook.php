<?php
// Start the session
session_start();

// Include the database connection file
include("dbconn.php");

// Get the values from the POST request
$username = $_POST['c_username'];
$cartype = $_POST['b_cartype'];
$plateno = $_POST['b_plateno'];
$washtype = $_POST['b_washtype'];
$date = $_POST['b_date'];
$time = $_POST['b_time'];
$amount = $_POST['b_amount'];

// Function to generate a unique bookID
function generateUniqueBookID($dbconn) {
    do {
        $randomID = 'b' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $query = "SELECT bookID FROM booking WHERE bookID = '$randomID'";
        $result = mysqli_query($dbconn, $query);
    } while (mysqli_num_rows($result) > 0);
    return $randomID;
}

// Generate a unique bookID
$bookID = generateUniqueBookID($dbconn);

// Prepare the SQL query
$sql2 = "INSERT INTO booking (bookID, custUsername, bookDate, bookTime, bookStatus, bookServiceType, bookAmount, carType, plateNumber) 
VALUES ('$bookID', '$username', '$date', '$time', 'Pending', '$washtype', '$amount', '$cartype', '$plateno')";

// Execute the query and handle errors
if (mysqli_query($dbconn, $sql2)) {
    echo $bookID;
} else {
    die("Error: " . mysqli_error($dbconn));
}
?>

<?php
// Start the session
session_start();

// Include the database connection file
include("dbconn.php");

// Get the values from the POST request
$bookID = $_POST['b_id'];
$payMethod = $_POST['p_method'];
$payAmount = $_POST['p_amount'];
$payBank = $_POST['p_bank'];
$payAccNum = $_POST['p_accnum'];

// Function to generate a unique payID
function generateUniquePayID($dbconn) {
    do {
        $randomID = 'p' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $query = "SELECT payID FROM payment WHERE payID = '$randomID'";
        $result = mysqli_query($dbconn, $query);
    } while (mysqli_num_rows($result) > 0);
    return $randomID;
}

// Generate a unique payID
$payID = generateUniquePayID($dbconn);

// Check the payment method and set bank and account number values
if ($payMethod == 'Cash') {
    $payBank = '-';
    $payAccNum = '-';
}

// Prepare the SQL query
$sql2 = "INSERT INTO payment (payID, bookID, payMethod, payAmount, payBankName, payAccNum) 
VALUES (?, ?, ?, ?, ?, ?)";

// Initialize a statement
$stmt = mysqli_prepare($dbconn, $sql2);

// Bind parameters to the statement
mysqli_stmt_bind_param($stmt, "ssssss", $payID, $bookID, $payMethod, $payAmount, $payBank, $payAccNum);

// Execute the statement and handle errors
if (mysqli_stmt_execute($stmt)) {
    echo "Payment details have been saved with payID: $payID";
} else {
    die("Error: " . mysqli_error($dbconn));
}

// Close the statement and the database connection
mysqli_stmt_close($stmt);
mysqli_close($dbconn);
?>

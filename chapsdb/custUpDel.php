<?php
// include db connection file
include("dbconn.php");

// If the update button is clicked
if(isset($_POST['update'])){
    // capture values from HTML form
    $cust_ID= $_POST['custID'];
	$cust_name= $_POST['custName'];
	$cust_phone= $_POST['custPhone'];
	$cust_address= $_POST['custAddress'];
    $cust_postcode= $_POST['custPostcode'];
	$cust_state= $_POST['custState'];
	$cust_email= $_POST['custEmail'];

    // Check if a new password has been entered
    $password = $_POST['password'];
    if (!empty($password)) {
        $password = md5($password); // Apply MD5 to the new password
    } else {
        // If no new password is entered, keep the old password
        $sqlPassword = "SELECT password FROM customer WHERE custID= '$cust_ID'";
        $queryPassword = mysqli_query($dbconn, $sqlPassword) or die("Error: " . mysqli_error($dbconn));
        $rowPassword = mysqli_fetch_assoc($queryPassword);
        $password = $rowPassword['password'];
    }

    // Check if the record exists
    $sqlSel = "SELECT * FROM customer WHERE custID= '$cust_ID'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);
    if ($rowSel == 0) {
        echo "<script>alert('Record does not exist!'); window.location= 'menu_customer.php'</script>";
    } else {
        // Execute SQL UPDATE command
        $sqlUpdate = "UPDATE customer SET custName = '$cust_name', custPhone = '$cust_phone', custAddress = '$cust_address', custPostcode = '$cust_postcode', custState = '$cust_state', custEmail = '$cust_email', password = '$password' WHERE custID = '$cust_ID'";
        
        mysqli_query($dbconn, $sqlUpdate) or die("Error updating record: " . mysqli_error($dbconn));
        
        // Display a message and redirect
        echo "<script>alert('Data has been updated!'); window.location= 'menu_customer.php'</script>";
    }
    } elseif (isset($_POST['delete'])) {
        // If the delete button is clicked
        $cust_ID = mysqli_real_escape_string($dbconn, $_POST['custID']);
        
        // Execute SQL DELETE command
        $sqlDelete = "DELETE FROM customer WHERE custID = '$cust_ID'";
        
        mysqli_query($dbconn, $sqlDelete) or die("Error deleting record: " . mysqli_error($dbconn));
        
        // Display a message and redirect
        echo "<script>alert('Data has been deleted!'); window.location= 'menu_customer.php'</script>";
    } else {
        // Redirect if neither update nor delete button was clicked
        echo "<script>alert('Error! Action unsuccessful'); window.location= 'menu_customer.php'</script>";
    }

    mysqli_close($dbconn);
?>

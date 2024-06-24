<?php
// include db connection file
include("dbconn.php");

// If the update button is clicked
if(isset($_POST['update'])){
    // capture values from HTML form
    $sup_ID = $_POST['supID'];
    $sup_name = $_POST['supName'];
    $sup_address = $_POST['supAddress'];
    $sup_state = $_POST['supState'];
    $sup_phone = $_POST['supPhone'];
    $sup_email= $_POST['supEmail'];

    // apply sql statement to verify the specified info first
    $sqlSel = "SELECT * FROM supplier WHERE supID= '$sup_ID'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);
    if($rowSel == 0){
        echo "<script>alert('Record does not exist!'); window.location= 'menu_supplier.php'</script>";
    }
    else{
        // execute SQL UPDATE command
        $sqlUpdate = "UPDATE supplier SET supName = '" . $sup_name . "',
        supAddress= '" . $sup_address . "', supState = '" . $sup_state . "',supPhone = '" . $sup_phone ."' ,supEmail = '" . $sup_email ."' where supID = '" . $sup_ID . "'";

        echo "<br>";
        mysqli_query($dbconn, $sqlUpdate) or die("Error: " . mysqli_error($dbconn));
        // display a message
        echo "<script>alert('Data has been updated!'); window.location= 'menu_supplier.php'</script>";
    }
}
else {
    // If the delete button is clicked
    if(isset($_POST['delete'])){
        // capture values from HTML form
        $sup_ID = $_POST['supID'];
        // execute SQL DELETE command
        $sqlDelete = "DELETE FROM supplier WHERE supID = '" . $sup_ID . "'  ";

        echo "<br>";
        mysqli_query($dbconn, $sqlDelete) or die("Error: " . mysqli_error($dbconn));
        // display a message
        echo "<script>alert('Data has been deleted!'); window.location= 'menu_supplier.php'</script>";
    }
    else{
        echo "<script>alert('Error! Delete unsuccessful'); window.location= 'menu_supplier.php'</script>";
    }
}

?>
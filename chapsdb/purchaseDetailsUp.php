<?php
include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $purID = $_POST['purID'];
    $shipDate = $_POST['shipDate'];
    $status = $_POST['status'];

    // Update query for purchase table
    $update_purchase = "UPDATE purchase SET purShipDate = '$shipDate', purStatus = '$status' WHERE purID = '$purID'";
    $result_update = mysqli_query($dbconn, $update_purchase);

    if ($result_update) {
        // Redirect to menu_PStatus.php upon successful update
        echo "<script>alert('Purchase status has been updated!'); window.location= 'menu_PStatus.php'</script>";
        exit();
    } else {
        echo "<script>alert('Error! Please try again.'); window.location= 'menu_PStatus.php'</script>";
    }
} else {
    echo "Invalid request method.";
}
?>

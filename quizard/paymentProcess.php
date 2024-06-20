<?php
include("dbconn.php");

$stud_ID = $_POST['studID'];
$bank_name = $_POST['bankName'];
$bank_account = $_POST['bankAcc'];
$pay_date = $_POST['payDate'];

// Check if studID already exists in the payment table
$check = "SELECT * FROM payment WHERE studID='$stud_ID'";
$check_result = mysqli_query($dbconn, $check);

if (mysqli_num_rows($check_result) > 0) {
    echo "<script>alert('Error! Your account is already premium.'); window.location= 'homeSubject.php'</script>";
} else {
    $sql = "INSERT INTO payment (bankName, bankAcc, payDate, studID) VALUES ('$bank_name', '$bank_account', '$pay_date', '$stud_ID')";

    if (mysqli_query($dbconn, $sql)) {
        // Update the student record to set isPremium to true
        $sqlUpdate = "UPDATE student SET isPremium=true WHERE studID='$stud_ID'";

        if (mysqli_query($dbconn, $sqlUpdate)) {
            echo "<script>alert('Payment successful! Your account is now premium!'); window.location= 'homeSubject.php'</script>";
        } else {
            echo "Error updating record: " . mysqli_error($dbconn);
        }
    } else {
        echo "<script>alert('Error! Please try again'); window.location= 'homeSubject.php'</script>";
        echo "Error: " . mysqli_error($dbconn);
    }
}

mysqli_close($dbconn);
?>

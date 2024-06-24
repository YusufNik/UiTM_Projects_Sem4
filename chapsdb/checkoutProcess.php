<?php
include("dbconn.php");
session_start();

    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }

    $amount = $_SESSION['amount'];
    $bankName = $_POST["bankName"];
    $accNum = $_POST["accNum"];
    $payDate = $_POST["payDate"];
    $purID = $_POST["purID"];

    $sql = "INSERT INTO payment (amount, bankName, accNum, payDate, purID) 
            VALUES ('$amount', '$bankName', '$accNum', '$payDate', '$purID')";

    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        echo "<script>alert('Payment success! Thank you for buying our products'); window.location= 'menu_catalog.php'</script>";
    } else {
        echo "<script>alert('Error! Please try again'); window.location= 'customerCart.php'</script>";
        echo "Error: " . mysqli_error($dbconn);
    }
// }
mysqli_close($dbconn);
?>
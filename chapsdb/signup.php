<?php
include('dbconn.php');

if(isset($_POST["custID"])) {
    $custID = $_POST['custID'];
    $custName = $_POST['custName'];
    $custPhone = $_POST['custPhone'];
    $custAddress = $_POST['custAddress'];
    $custPostcode = $_POST['custPostcode'];
    $custState = $_POST['custState'];
    $custEmail = $_POST['custEmail'];
    $password = md5($_POST['password']); // Apply MD5 to the password
    
     // Check if custID already exists in customer table
    $check_cust = "SELECT * FROM customer WHERE custID='$custID'";
    $check_result_cust = mysqli_query($dbconn, $check_cust);

    // Check if custID exists in employee table
    $check_emp = "SELECT * FROM employee WHERE empID='$custID'";
    $check_result_emp = mysqli_query($dbconn, $check_emp);

    // Check if either custID or empID exists
    if (mysqli_num_rows($check_result_cust) > 0 || mysqli_num_rows($check_result_emp) > 0) {
        echo "<script>alert('Username already exists! Please choose a different username.'); window.location= 'login.html'</script>";
    } else {
        // Insert new customer
        $sql = "INSERT INTO customer (custID, custName, custPhone, custAddress, custPostcode, custState, custEmail, password) 
                VALUES ('$custID', '$custName', '$custPhone', '$custAddress', '$custPostcode', '$custState', '$custEmail', '$password')";

        $result = mysqli_query($dbconn, $sql);

        if($result) {
            echo "<script>alert('Successfully registered!'); window.location= 'login.html';</script>";
        } else {
            echo "<script>alert('Error! Please try again.'); window.location= 'login.html';</script>";
        }
    }
}
?>
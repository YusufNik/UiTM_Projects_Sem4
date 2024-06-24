<?php
include('dbconn.php');
session_start();

if(isset($_POST['userid'])) {
    $userid = $_POST['userid'];
    $password = md5($_POST['password']); // apply MD5 hash if necessary
    
    // Check other users (assuming it's customer or staff)
    $sql = "SELECT * FROM customer WHERE custID = '$userid' AND password = '$password'";
    $result = mysqli_query($dbconn, $sql);
    $customer = mysqli_fetch_array($result);
    
    if ($customer) {
        $_SESSION['custID'] = $customer['custID'];
        $_SESSION['custName'] = $customer['custName'];
        $_SESSION['custPhone'] = $customer['custPhone'];
        $_SESSION['custAddress'] = $customer['custAddress'];
        $_SESSION['custPostcode'] = $customer['custPostcode'];
        $_SESSION['custState'] = $customer['custState'];
        $_SESSION['custEmail'] = $customer['custEmail'];
        $_SESSION['password'] = $customer['password'];
        $_SESSION['status'] = 'customer';
        
        echo "<script>alert('Login Successful!'); window.location= 'menu_catalog.php'</script>";
        exit; 
    } 
    
    // Check if it's the admin account
    $sql = "SELECT * FROM employee WHERE empID = '$userid' AND password = '$password'";
    $result = mysqli_query($dbconn, $sql);
    $employee = mysqli_fetch_array($result);
    if ($userid == 'admin' && $password == '698d51a19d8a121ce581499d7b701668') {
        $_SESSION['empID'] = $employee['empID'];
        $_SESSION['empName'] = $employee['empName'];
        $_SESSION['empIC'] = $employee['empIC'];
        $_SESSION['empPhone'] = $employee['empPhone'];
        $_SESSION['empEmail'] = $employee['empEmail'];
        $_SESSION['empAddress'] = $employee['empAddress'];
        $_SESSION['empHireDate'] = $employee['empHireDate'];
        $_SESSION['empPic'] = $employee['empPic'];
        $_SESSION['password'] = $employee['password'];
        $_SESSION['status'] = 'admin';

        echo "<script>alert('Login Successful!'); window.location= 'menu_home.php'</script>";
        exit; 
    }
    
    // If not found in customer, check in employee table for staff
    if ($employee) {
        $_SESSION['empID'] = $employee['empID'];
        $_SESSION['empName'] = $employee['empName'];
        $_SESSION['empIC'] = $employee['empIC'];
        $_SESSION['empPhone'] = $employee['empPhone'];
        $_SESSION['empEmail'] = $employee['empEmail'];
        $_SESSION['empAddress'] = $employee['empAddress'];
        $_SESSION['empHireDate'] = $employee['empHireDate'];
        $_SESSION['empPic'] = $employee['empPic'];
        $_SESSION['password'] = $employee['password'];
        $_SESSION['status'] = 'staff';
        
        echo "<script>alert('Login Successful!'); window.location= 'menu_homeS.php'</script>";
        exit;
    }
    
    // If no match found, show error message
    echo "<script>alert('Error! Incorrect username or password'); window.location= 'login.html'</script>";
}
?>

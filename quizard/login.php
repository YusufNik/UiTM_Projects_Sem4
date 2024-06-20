<?php
include('dbconn.php');
session_start();

if(isset($_POST['userid'])) {
    $userid = $_POST['userid'];
    $password = md5($_POST['password']); //apply MD5 hash
    
    // Check student table
    $sql = "SELECT * FROM student";
    $result = mysqli_query($dbconn, $sql);
    $found = FALSE;
    
    while($student = mysqli_fetch_array($result)) {
        if ($student['studID'] == $userid && $student["password"] == $password) {
            $found = TRUE;
            $_SESSION['studID'] = $student['studID'];
            $_SESSION['studName'] = $student['studName'];
            $_SESSION['studPhone'] = $student['studPhone'];
            $_SESSION['studEmail'] = $student['studEmail'];
            $_SESSION['studSchool'] = $student['studSchool'];
            $_SESSION['status'] = 'student';
            break;
        }
    }
    
    // Check admin table if not found in student table
    if (!$found) {
        $sql = "SELECT * FROM admin";
        $result = mysqli_query($dbconn, $sql); 
        
        while($admin = mysqli_fetch_array($result)) {
            if ($admin['adminID'] == $userid && $admin["password"] == $password) {
                $found = TRUE;
                $_SESSION['adminID'] = $admin['adminID'];
                $_SESSION['adminName'] = $admin['adminName'];
                $_SESSION['adminIC'] = $admin['adminIC'];
                $_SESSION['adminPhone'] = $admin['adminPhone'];  
                $_SESSION['adminAddress'] = $admin['adminAddress'];
                $_SESSION['adminEmail'] = $admin['adminEmail'];
                $_SESSION['adminQualification'] = $admin['adminQualification'];
                $_SESSION['adminMajor'] = $admin['adminMajor'];
                $_SESSION['status'] = 'admin';
                break;
            }
        }
    }
    
    if ($found) {
        if ($_SESSION['status'] == 'admin') {
            echo "<script>alert('Login Successful!'); window.location= 'menu_home.php'</script>";
        } else {
            echo "<script>alert('Login Successful!'); window.location= 'homeSubject.php'</script>"; }
    } else {
        echo "<script>alert('Error! Incorrect username or password'); window.location= 'login.html'</script>";
    }
}
?>

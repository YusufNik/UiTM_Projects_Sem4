<?php
include('dbconn.php');

if(isset($_POST["studID"])) {
    $studID = $_POST['studID'];
    $studName = $_POST['studName'];
    $studPhone = $_POST['studPhone'];
    $studEmail = $_POST['studEmail'];
    $studSchool = $_POST['studSchool'];
    $password = md5($_POST['password']); // Apply MD5 to the password
    
    // Check if studID already exists or not?
    $check = "SELECT * FROM student WHERE studID='$studID'";
    $check_result = mysqli_query($dbconn, $check); //check db(current db, sql statement)

    if (mysqli_num_rows($check_result) > 0) {  //check each row (if detected consider alr existed else proceed insert)
        echo "<script>alert('Username already exists! Please choose a different username.'); window.location= 'login.html'</script>";
    } else {
        $sql = "INSERT INTO student (studID, studName, studPhone, studEmail, studSchool, password) VALUES ('$studID', '$studName', '$studPhone', '$studEmail', '$studSchool', '$password')";
    }

    $result = mysqli_query($dbconn, $sql);

    if($result) {
        echo "<script>alert('Successfully registered!'); window.location= 'login.html';</script>";
    } else {
        echo "<script>alert('Error! Please try again.'); window.location= 'signup.php';</script>";
    }
}
?>

<?php
// include db connection file
include("dbconn.php");

// If the update button is clicked
if(isset($_POST['update'])){
    // capture values from HTML form
    $stud_ID= $_POST['studID'];
    $stud_name= $_POST['studName'];
    $stud_phone= $_POST['studPhone'];
    $stud_email= $_POST['studEmail'];
    $stud_school= $_POST['studSchool'];

    // Check if a new password has been entered
    $password = $_POST['password'];
    if (!empty($password)) {
        $password = md5($password); // Apply MD5 to the new password
    } else {
        // If no new password is entered, keep the old password
        $sqlPassword = "SELECT password FROM student WHERE studID= '$stud_ID'";
        $queryPassword = mysqli_query($dbconn, $sqlPassword) or die("Error: " . mysqli_error($dbconn));
        $rowPassword = mysqli_fetch_assoc($queryPassword);
        $password = $rowPassword['password'];
    }

    // apply sql statement to verify the specified info first
    $sqlSel = "SELECT * FROM student WHERE studID= '$stud_ID'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);
    if($rowSel == 0){
        echo "<script>alert('Record does not exist!'); window.location= 'menu_student.php'</script>";
    }
    else{
        // execute SQL UPDATE command
        $sqlUpdate = "UPDATE student SET studName = '" . $stud_name . "',
        studPhone= '" . $stud_phone . "', studEmail = '" . $stud_email . "', studSchool = '" . $stud_school ."', password = '" . $password ."' where studID = '" . $stud_ID . "'";

        echo "<br>";
        mysqli_query($dbconn, $sqlUpdate) or die("Error: " . mysqli_error($dbconn));
        // display a message
        echo "<script>alert('Data has been updated!'); window.location= 'menu_student.php'</script>";
    }
}
else {
    // If the delete button is clicked
    if(isset($_POST['delete'])){
        // capture values from HTML form
        $stud_ID = $_POST['studID'];
        // execute SQL DELETE command
        $sqlDelete = "DELETE FROM student WHERE studID = '" . $stud_ID . "'  ";

        echo "<br>";
        mysqli_query($dbconn, $sqlDelete) or die("Error: " . mysqli_error($dbconn));
        // display a message
        echo "<script>alert('Data has been deleted!'); window.location= 'menu_student.php'</script>";
    }
    else{
        echo "<script>alert('Error! Delete unsuccessful'); window.location= 'menu_student.php'</script>";
    }
}
?>
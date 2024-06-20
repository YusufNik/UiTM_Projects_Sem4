<?php
    include("dbconn.php");

    $stud_ID= $_POST['studID'];
	$stud_name= $_POST['studName'];
	$stud_phone= $_POST['studPhone'];
	$stud_email= $_POST['studEmail'];
	$stud_school= $_POST['studSchool'];
    $password= md5($_POST['password']);// Apply MD5 to the password

    // Check if studID already exists
    $check = "SELECT * FROM student WHERE studID='$stud_ID'";
    $check_result = mysqli_query($dbconn, $check); //check db(current db, sql statement)

    if (mysqli_num_rows($check_result) > 0) {  //check each row (if detected consider alr existed else proceed insert)
        echo "<script>alert('Student ID already exists! Please choose a different ID.'); window.location= 'menu_student.php'</script>";
    } else {
        $sql = "INSERT INTO student (studID, studName, studPhone, studEmail, studSchool, password) VALUES('$stud_ID', '$stud_name','$stud_phone','$stud_email','$stud_school','$password')";
    }

    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        echo "<script>alert('Successfully Added!'); window.location= 'menu_student.php'</script>";
    } else {
        echo "<script>alert('Error! Please try again'); window.location= 'menu_student.php'</script>";
        echo "Error: " . mysqli_error($dbconn);
    }
    mysqli_close($dbconn);
?>
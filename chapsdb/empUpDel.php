<?php
// Include db connection file
include("dbconn.php");

// If the update button is clicked
if (isset($_POST['update'])) {
    $emp_ID= $_POST['empID'];
    $emp_name= $_POST['empName'];
    $emp_IC= $_POST['empIC'];
    $emp_phone= $_POST['empPhone'];
    $emp_email= $_POST['empEmail'];
    $emp_address= $_POST['empAddress'];
    $emp_state= $_POST['empState'];
    $emp_hire_date= $_POST['empHireDate'];

    // Check if a new picture has been uploaded
    if (!empty($_FILES['empPic']['name'])) {
        $emp_pic_temp = $_FILES['empPic']['name'];
        $emp_pic = "image/" . $emp_pic_temp;

        // Check if the upload directory exists and is writable
        if (!is_dir('image')) {
            mkdir('image', 0777, true);
        }

        // Move uploaded file to the destination directory
        if (!move_uploaded_file($_FILES['empPic']['tmp_name'], $emp_pic)) {
            die("Error uploading image file.");
        }
    } else {
        // If no new picture is uploaded, keep the old picture
        $sqlPic = "SELECT empPic FROM employee WHERE empID= '$emp_ID'";
        $queryPic = mysqli_query($dbconn, $sqlPic) or die("Error: " . mysqli_error($dbconn));
        $rowPic = mysqli_fetch_assoc($queryPic);
        $emp_pic = $rowPic['empPic'];
    }   

    // Check if a new password has been entered
    $password = $_POST['password'];
    if (!empty($password)) {
        $password = md5($password); // Apply MD5 to the new password
    } else {
        // If no new password is entered, keep the old password
        $sqlPassword = "SELECT password FROM employee WHERE empID= '$emp_ID'";
        $queryPassword = mysqli_query($dbconn, $sqlPassword) or die("Error: " . mysqli_error($dbconn));
        $rowPassword = mysqli_fetch_assoc($queryPassword);
        $password = $rowPassword['password'];
    }

    // Apply SQL statement to verify the specified info first
    $sqlSel = "SELECT * FROM employee WHERE empID= '$emp_ID'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);
    if ($rowSel == 0) {
        echo "<script>alert('Record does not exist!'); window.location= 'menu_employee.php'</script>";
    } else {
        // Execute SQL UPDATE command
        $sqlUpdate = "UPDATE employee SET 
            empName = '$emp_name',
            empIC = '$emp_IC',
            empPhone = '$emp_phone',
            empEmail = '$emp_email',
            empAddress = '$emp_address',
            empState = '$emp_state',
            empHireDate = '$emp_hire_date',
            empPic = '$emp_pic',
            password = '$password'
            WHERE empID = '$emp_ID'";

        mysqli_query($dbconn, $sqlUpdate) or die("Error: " . mysqli_error($dbconn));
        // Display a message
        echo "<script>alert('Data has been updated!'); window.location= 'menu_employee.php'</script>";
    }
} else {
    // If the delete button is clicked
    if (isset($_POST['delete'])) {
        // Capture values from HTML form
        $emp_ID = $_POST['empID'];
        // Execute SQL DELETE command
        $sqlDelete = "DELETE FROM employee WHERE empID = '$emp_ID'";

        mysqli_query($dbconn, $sqlDelete) or die("Error: " . mysqli_error($dbconn));
        // Display a message
        echo "<script>alert('Data has been deleted!'); window.location= 'menu_employee.php'</script>";
    } else {
        echo "<script>alert('Error! Delete unsuccessful'); window.location= 'menu_employee.php'</script>";
    }
}
?>
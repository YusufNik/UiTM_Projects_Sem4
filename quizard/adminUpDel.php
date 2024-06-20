<?php
// Include db connection file
include("dbconn.php");

// If the update button is clicked
if (isset($_POST['update'])) {
    // Capture values from HTML form
    $admin_ID = $_POST['adminID'];
    $admin_name = $_POST['adminName'];
    $admin_IC = $_POST['adminIC'];
    $admin_phone = $_POST['adminPhone'];
    $admin_address = $_POST['adminAddress'];
    $admin_email = $_POST['adminEmail'];
    $admin_qualification = $_POST['adminQualification'];
    $admin_major = $_POST['adminMajor'];

    // Check if a new password has been entered
    $password = $_POST['password'];
    if (!empty($password)) {
        $password = md5($password); // Apply MD5 to the new password
    } else {
        // If no new password is entered, keep the old password
        $sqlPassword = "SELECT password FROM admin WHERE adminID= '$admin_ID'";
        $queryPassword = mysqli_query($dbconn, $sqlPassword) or die("Error: " . mysqli_error($dbconn));
        $rowPassword = mysqli_fetch_assoc($queryPassword);
        $password = $rowPassword['password'];
    }

    // Check if a new picture has been uploaded
    if (!empty($_FILES['adminPic']['name'])) {
        $admin_pic_temp = $_FILES['adminPic']['name'];
        $admin_pic = "image/" . $admin_pic_temp;
        // Move uploaded file to the destination directory
        move_uploaded_file($_FILES['adminPic']['tmp_name'], $admin_pic);
    } else {
        // If no new picture is uploaded, keep the old picture
        $sqlPic = "SELECT adminPic FROM admin WHERE adminID= '$admin_ID'";
        $queryPic = mysqli_query($dbconn, $sqlPic) or die("Error: " . mysqli_error($dbconn));
        $rowPic = mysqli_fetch_assoc($queryPic);
        $admin_pic = $rowPic['adminPic'];
    }

    // Apply SQL statement to verify the specified info first
    $sqlSel = "SELECT * FROM admin WHERE adminID= '$admin_ID'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);
    if ($rowSel == 0) {
        echo "<script>alert('Record does not exist!'); window.location= 'menu_admin.php'</script>";
    } else {
        // Execute SQL UPDATE command
        $sqlUpdate = "UPDATE admin SET 
            adminName = '$admin_name',
            adminIC = '$admin_IC',
            adminPhone = '$admin_phone',
            adminAddress = '$admin_address',
            adminEmail = '$admin_email',
            adminQualification = '$admin_qualification',
            adminMajor = '$admin_major',
            adminPic = '$admin_pic',
            password = '$password'
            WHERE adminID = '$admin_ID'";

        mysqli_query($dbconn, $sqlUpdate) or die("Error: " . mysqli_error($dbconn));
        // Display a message
        echo "<script>alert('Data has been updated!'); window.location= 'menu_admin.php'</script>";
    }
} else {
    // If the delete button is clicked
    if (isset($_POST['delete'])) {
        // Capture values from HTML form
        $admin_ID = $_POST['adminID'];
        // Execute SQL DELETE command
        $sqlDelete = "DELETE FROM admin WHERE adminID = '$admin_ID'";

        mysqli_query($dbconn, $sqlDelete) or die("Error: " . mysqli_error($dbconn));
        // Display a message
        echo "<script>alert('Data has been deleted!'); window.location= 'menu_admin.php'</script>";
    } else {
        echo "<script>alert('Error! Delete unsuccessful'); window.location= 'menu_admin.php'</script>";
    }
}
?>
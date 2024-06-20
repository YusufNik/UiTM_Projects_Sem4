<?php
include("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_ID = $_POST['adminID'];
    $admin_name = $_POST['adminName'];
    $admin_IC = $_POST['adminIC'];
    $admin_phone = $_POST['adminPhone'];
    $admin_address = $_POST['adminAddress'];
    $admin_email = $_POST['adminEmail'];
    $admin_quali = $_POST['adminQualification'];
    $admin_major = $_POST['adminMajor'];

    // Check if a new picture has been uploaded
    if (!empty($_FILES['adminPic']['name'])) {
        $admin_pic_temp = $_FILES['adminPic']['name'];
        $admin_pic = "image/" . $admin_pic_temp;
        // Move uploaded file to the destination directory
        move_uploaded_file($_FILES['adminPic']['tmp_name'], $admin_pic);
    } else {
        $admin_pic = ''; // No picture uploaded
    }

    $admin_password = md5($_POST['password']); // Apply MD5 to the password

    // Check if adminID already exists
    $check_query = "SELECT * FROM admin WHERE adminID='$admin_ID'";
    $check_result = mysqli_query($dbconn, $check_query); // Check db(current db, sql statement)

    if (mysqli_num_rows($check_result) > 0) { // Check each row (if detected consider already existed else proceed insert)
        echo "<script>alert('Admin ID already exists! Please choose a different ID.'); window.location= 'menu_admin.php'</script>";
    } else {
        // Insert new admin record
        $sql = "INSERT INTO admin (adminID, adminName, adminIC, adminPhone, adminAddress, adminEmail, adminQualification, adminMajor, adminPic, password) 
                VALUES ('$admin_ID', '$admin_name', '$admin_IC', '$admin_phone', '$admin_address', '$admin_email', '$admin_quali', 
                '$admin_major', '$admin_pic', '$admin_password')";

        $result = mysqli_query($dbconn, $sql);

        if ($result) {
            echo "<script>alert('Successfully Added!'); window.location= 'menu_admin.php'</script>";
        } else {
            echo "<script>alert('Error! Please try again'); window.location= 'menu_admin.php'</script>";
        }
    }

    mysqli_close($dbconn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Add Admin</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="adminAdd.php" method="post" enctype="multipart/form-data">
                <h1>ADD NEW ADMIN</h1>
                <br>
                <input type="text" name="adminID" placeholder="Admin ID" required>
                <input type="text" name="adminName" placeholder="Full Name" required>
                <input type="text" name="adminIC" placeholder="Identity Card" required>
                <input type="text" name="adminPhone" placeholder="Phone" required>
                <input type="text" name="adminAddress" placeholder="Address" required>
                <input type="email" name="adminEmail" placeholder="Email" required>
                <input type="text" name="adminQualification" placeholder="Qualification" required>
                <input type="text" name="adminMajor" placeholder="Major" required>
                <input type="file" name="adminPic" accept="image/jpeg, image/png, image/jpg" required>
                <input type="password" name="password" placeholder="Password" required>

                <table>
                    <tr>
                        <td rowspan="2">
                            <button type="button" onclick="window.location.href='menu_admin.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                        </td>
                        <td>
                            <button type="submit"><span class="material-symbols-outlined">school</span>ADD</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>

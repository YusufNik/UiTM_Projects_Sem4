<?php
include("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sub_id = $_POST['subID'];
    $sub_name = $_POST['subName'];
    $sub_create = $_POST['subCreate'];
    $admin_id = $_POST['adminID'];
    $sub_desc = $_POST['subDesc'];

    // Check if a new banner has been uploaded
    if (!empty($_FILES['subBan']['name'])) {
        $sub_ban_temp = $_FILES['subBan']['name'];
        $sub_ban = "image/" . $sub_ban_temp;
        // Move uploaded file to the destination directory
        if (move_uploaded_file($_FILES['subBan']['tmp_name'], $sub_ban)) {
            // Check if subID already exists
            $check_query = "SELECT * FROM subject WHERE subID='$sub_id'";
            $check_result = mysqli_query($dbconn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                echo "<script>alert('Subject ID already exists! Please choose a different ID.'); window.location= 'menu_subject.php'</script>";
            } else {
                // Insert new subject record
                $sql = "INSERT INTO subject (subID, subName, subCreate, subDesc, adminID, subBan) 
                        VALUES('$sub_id', '$sub_name', '$sub_create', '$sub_desc', '$admin_id', '$sub_ban')";
                $result = mysqli_query($dbconn, $sql);

                if ($result) {
                    echo "<script>alert('Successfully Added!'); window.location= 'menu_subject.php'</script>";
                } else {
                    echo "<script>alert('Error! Please try again'); window.location= 'menu_subject.php'</script>";
                }
            }
        } else {
            echo "<script>alert('Error uploading file. Please try again.'); window.location= 'menu_subject.php'</script>";
        }
    } else {
        echo "<script>alert('Please upload a banner image.'); window.location= 'menu_subject.php'</script>";
    }

    mysqli_close($dbconn);
}

$admin = "SELECT adminID, adminName FROM admin";
$admin_query = mysqli_query($dbconn, $admin) or die("Error: " . mysqli_error($dbconn));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Add Subject</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="subAdd.php" method="post" enctype="multipart/form-data">
                <h1>ADD NEW SUBJECT</h1>
                <br>
                <input type="text" name="subID" placeholder="Subject ID" required>
                <input type="text" name="subName" placeholder="Subject Name" required>
                <input type="date" name="subCreate" placeholder="Date Created" required>
                <input type="text" name="subDesc" placeholder="Subject Description" required>
                <input type="file" name="subBan" accept="image/jpeg, image/png, image/jpg" required>
                <select name="adminID" class="option" required>
                    <option value="" disabled selected>Choose Admin</option>
                    <?php 
                    while ($admin = mysqli_fetch_assoc($admin_query)) {
                        echo "<option value='" . $admin['adminID'] . "'>" . $admin['adminName'] . "</option>";
                    }
                    ?>
                </select>
                <table>
                    <td rowspan="2">
                        <button type="button" onclick="window.location.href='menu_subject.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                    </td>
                    <td>
                        <button type="submit"><span class="material-symbols-outlined">subject</span>ADD</button>
                    </td>
                </table>
            </form>
        </div>
    </div>
</body>
</html>

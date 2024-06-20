<?php
// Include db connection file
include("dbconn.php");

// If the update button is clicked
if (isset($_POST['update'])) {
    // Capture values from HTML form
    $sub_id = $_POST['subID'];
    $sub_name = $_POST['subName'];
    $sub_create = $_POST['subCreate'];
    $sub_desc = $_POST['subDesc'];
    $admin_id = $_POST['adminID'];

    // Check if a new picture has been uploaded
    if (!empty($_FILES['subBan']['name'])) {
        $sub_ban_temp = $_FILES['subBan']['name'];
        $sub_ban = "image/" . $sub_ban_temp;
        // Move uploaded file to the destination directory
        move_uploaded_file($_FILES['subBan']['tmp_name'], $sub_ban);
    } else {
        // If no new picture is uploaded, keep the old picture
        $sqlPic = "SELECT subBan FROM subject WHERE subID= '$sub_id'";
        $queryPic = mysqli_query($dbconn, $sqlPic) or die("Error: " . mysqli_error($dbconn));
        $rowPic = mysqli_fetch_assoc($queryPic);
        $sub_ban = $rowPic['subBan'];
    }

    // Apply SQL statement to verify the specified info first
    $sqlSel = "SELECT * FROM subject WHERE subID= '$sub_id'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);
    if ($rowSel == 0) {
        echo "<script>alert('Record does not exist!'); window.location= 'menu_subject.php'</script>";
    } else {
        // Execute SQL UPDATE command
        $sqlUpdate = "UPDATE subject SET 
            subName = '$sub_name', 
            subCreate = '$sub_create', 
            subDesc = '$sub_desc',
            subBan = '$sub_ban',
            adminID = '$admin_id' 
            WHERE subID = '$sub_id'";

        if (mysqli_query($dbconn, $sqlUpdate)) {
            echo "<script>alert('Data has been updated!'); window.location= 'menu_subject.php'</script>";
        } else {
            echo "Error updating record: " . mysqli_error($dbconn);
        }
    }
} else if (isset($_POST['delete'])) {
    // If the delete button is clicked
    $sub_id = $_POST['subID'];
    // Execute SQL DELETE command
    $sqlDelete = "DELETE FROM subject WHERE subID = '$sub_id'";

    if (mysqli_query($dbconn, $sqlDelete)) {
        echo "<script>alert('Data has been deleted!'); window.location= 'menu_subject.php'</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($dbconn);
    }
} else {
    echo "<script>alert('Error! No action taken.'); window.location= 'menu_subject.php'</script>";
}
?>
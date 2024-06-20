<?php
include("dbconn.php");

$subID = $_REQUEST['sub_ID']; // Receive from the link: subMenu.php?sub_ID=".$row["subID"]

// Create SQL statement to retrieve data from the subject table
$sql = "SELECT * FROM subject WHERE subID= '$subID'";

// Execute SQL statement assigned to the $sql variable
$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

// Get the number of records from the subject table
$row = mysqli_num_rows($query);

if ($row == 0) {
    echo "No record found";
} else {
    // Since the records exist in the table,
    // fetch the record value of each column
    $r = mysqli_fetch_assoc($query);
    $sub_id = $r['subID'];
    $sub_name = $r['subName'];
    $sub_create = $r['subCreate'];
    $sub_desc = $r['subDesc'];
    $sub_ban = $r['subBan'];
    $admin_id = $r['adminID'];
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
    <title>Edit Subject</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="subUpDel.php" method="post" enctype="multipart/form-data">
                <h1>EDIT SUBJECT</h1>
                <br>
                <input type="text" name="subID" value="<?php echo $sub_id; ?>" readonly onclick="displayMessage()">
                <input type="text" name="subName" value="<?php echo $sub_name; ?>" placeholder="Subject Name" required>
                <input type="date" name="subCreate" value="<?php echo $sub_create; ?>" placeholder="Date Create" required>
                <input type="text" name="subDesc" value="<?php echo $sub_desc; ?>" placeholder="Subject Description" required>
                <input type="file" name="subBan" accept="image/jpeg, image/png, image/jpg">
                <select name='adminID' class='option' required>
					<?php 
					while ($admin = mysqli_fetch_assoc($admin_query)) {
						$selected = ($admin['adminID'] == $admin_id) ? "selected" : "";
						echo "<option value='" . $admin['adminID'] . "' $selected>" . $admin['adminName'] . "</option>";
					}
					?>
				</select>

                <table>
                    <tr>
                        <td rowspan="2">
                            <button type="button" onclick="window.location.href='menu_subject.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                        </td>
                        <td><button type="submit" name="update" value="Update"><span class="material-symbols-outlined">update</span>Update</button></td>
                        <td><button type="submit" name="delete" value="Delete"><span class="material-symbols-outlined">delete</span>Delete</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
<script>
function displayMessage() {
    alert("This field cannot be changed.");
}
</script>
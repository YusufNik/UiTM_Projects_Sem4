<?php
include("dbconn.php");

$adminID = $_REQUEST['admin_ID']; // Receive from the link : adminMenu.php?admin_ID=".$row["adminID"]

// Create SQL statement to retrieve data from the admin table
$sql = "SELECT * FROM admin WHERE adminID= '$adminID'";

// Execute SQL statement assigned to the $sql variable
$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

// Get the number of records from the admin table
$row = mysqli_num_rows($query);

if($row == 0){
    echo "No record found";
} else { 
    // Fetch the record value of each column
    $r = mysqli_fetch_assoc($query);
    $admin_ID = $r['adminID'];
    $admin_name = $r['adminName'];
    $admin_IC = $r['adminIC'];
    $admin_phone = $r['adminPhone'];
    $admin_address = $r['adminAddress'];
    $admin_email = $r['adminEmail'];
    $admin_qualification = $r['adminQualification'];
    $admin_major = $r['adminMajor'];
    $admin_pic = $r['adminPic']; 
    $admin_password = ''; // Clear the password field for security
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Edit Admin</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="adminUpDel.php" method="post" enctype="multipart/form-data">
                <h1>EDIT ADMIN</h1>
                <br>
                <input type="text" name="adminID" value="<?php echo $admin_ID; ?>" readonly onclick="displayMessage()" re>
                <input type="text" name="adminName" value="<?php echo $admin_name; ?>" placeholder="Full Name" required>
                <input type="text" name="adminIC" value="<?php echo $admin_IC; ?>" placeholder="IC" required>
                <input type="text" name="adminPhone" value="<?php echo $admin_phone; ?>" placeholder="Phone" required>
                <input type="text" name="adminAddress" value="<?php echo $admin_address; ?>" placeholder="Address" required>
                <input type="email" name="adminEmail" value="<?php echo $admin_email; ?>" placeholder="Email" required>
                <input type="text" name="adminQualification" value="<?php echo $admin_qualification; ?>" placeholder="Qualification" required>
                <input type="text" name="adminMajor" value="<?php echo $admin_major; ?>" placeholder="Major" required>
                <input type="file" name="adminPic" accept="image/jpeg, image/png, image/jpg">
                <input type="password" name="password" placeholder="Password">

                <table>
                    <tr>
                        <td rowspan="2">
                            <button type="button" onclick="window.location.href='menu_admin.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
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
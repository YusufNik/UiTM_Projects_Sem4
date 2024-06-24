<?php
include("dbconn.php");
session_start();
if (!isset($_SESSION['empID'])) {
    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
    exit;
}

$empID = $_REQUEST['emp_ID']; #receive from the link : Editemployee.php?emp_ID=".$row["empID"]

#create SQL statement to retrieve data from the employee table
$sql= "SELECT * FROM employee WHERE empID= '$empID'";

#execute SQL statement that assigned to the $sql variable
$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

#get the number of records from the employee table
$row = mysqli_num_rows($query);

if($row == 0){
    echo "No record found";
}
else{ 
#since the records exist in the table, 
#then fetch the record value of each column
    $r = mysqli_fetch_assoc($query);
    $emp_ID= $r['empID'];
    $emp_name= $r['empName'];
    $emp_IC= $r['empIC'];
    $emp_phone= $r['empPhone'];
    $emp_email= $r['empEmail'];
    $emp_address= $r['empAddress'];
    $emp_state= $r['empState'];
    $emp_hire_date= $r['empHireDate'];
    $emp_pic= $r['empPic'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Update Employee</title>
</head>
<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
        <form action="empUpDel.php" method="post" enctype="multipart/form-data">
              
                <h1>UPDATE EMPLOYEE</h1>
                <br>
                <input type="text" name="empID" value="<?php echo $emp_ID; ?>" readonly onclick="displayMessage()" required>
                <input type="text" name="empName" value="<?php echo $emp_name; ?>" placeholder="Full Name" required>
                <input type="text" name="empIC" value="<?php echo $emp_IC; ?>" placeholder="IC" required>
                <input type="text" name="empPhone" value="<?php echo $emp_phone; ?>" placeholder="Phone" required>
                <input type="email" name="empEmail" value="<?php echo $emp_email; ?>" placeholder="Email" required>
                <input type="text" name="empAddress"  value="<?php echo $emp_address; ?>" placeholder="Address" required>
                <select name="empState" class="state" required>
                    <option value="Johor" <?php if ($emp_state == "Johor") echo "selected"; ?>>Johor</option>
                    <option value="Kedah" <?php if ($emp_state == "Kedah") echo "selected"; ?>>Kedah</option>
                    <option value="Kelantan" <?php if ($emp_state == "Kelantan") echo "selected"; ?>>Kelantan</option>
                    <option value="Melaka" <?php if ($emp_state == "Melaka") echo "selected"; ?>>Melaka</option>
                    <option value="Negeri Sembilan" <?php if ($emp_state == "Negeri Sembilan") echo "selected"; ?>>Negeri Sembilan</option>
                    <option value="Kuala Lumpur" <?php if ($emp_state == "Kuala Lumpur") echo "selected"; ?>>Kuala Lumpur</option>
                    <option value="Pahang" <?php if ($emp_state == "Pahang") echo "selected"; ?>>Pahang</option>
                    <option value="Pulau Pinang" <?php if ($emp_state == "Pulau Pinang") echo "selected"; ?>>Pulau Pinang</option>
                    <option value="Perak" <?php if ($emp_state == "Perak") echo "selected"; ?>>Perak</option>
                    <option value="Perlis" <?php if ($emp_state == "Perlis") echo "selected"; ?>>Perlis</option>
                    <option value="Selangor" <?php if ($emp_state == "Selangor") echo "selected"; ?>>Selangor</option>
                    <option value="Terengganu" <?php if ($emp_state == "Terengganu") echo "selected"; ?>>Terengganu</option>
                    <option value="Sarawak" <?php if ($emp_state == "Sarawak") echo "selected"; ?>>Sarawak</option>
                    <option value="Sabah" <?php if ($emp_state == "Sabah") echo "selected"; ?>>Sabah</option>
                </select>
                <input type="date" name="empHireDate" value="<?php echo $emp_hire_date; ?>" placeholder="Hire Date">
                <input type="file" name="empPic" accept="image/jpeg, image/png, image/jpg">
                <input type="password" name="password" placeholder="Password">

                <table>
                    <tr>
                        <td rowspan="2">
                        <button  type="button" onclick="window.location.href='menu_employee.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button></td>
                        <td><button type="submit" name="update" value="Update" class="button"><span class="material-symbols-outlined">update</span>Update</button></td>
                        <td><button type="submit" name="delete" value="Delete" class="button"><span class="material-symbols-outlined">delete</span>Delete</button></td> 
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
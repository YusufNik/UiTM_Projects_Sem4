<?php
include("dbconn.php");

$studID = $_REQUEST['stud_ID']; #receive from the link : studentMenu.php?stud_ID=".$row["studID"]

#create SQL statement to retrieve data from the product table
$sql= "SELECT studID, studName, studPhone, studEmail, studSchool, password FROM student WHERE studID= '$studID'";

#execute SQL statement that assigned to the $sql variable
$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

#get the number of records from the product table
$row = mysqli_num_rows($query);

if($row == 0){
    echo "No record found";
}
else{ 
#since the records exist in the table, 
#then fetch the record value of each column
    $r = mysqli_fetch_assoc($query);
    $stud_ID= $r['studID'];
    $stud_name= $r['studName'];
    $stud_phone= $r['studPhone'];
    $stud_email= $r['studEmail'];
    $stud_school= $r['studSchool'];
    $stud_password = ''; // Clear the password field for security
}   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Edit Student</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="studUpDel.php" method="post">
            
                <h1>EDIT STUDENT</h1>
                <br>
                <input type="text" name="studID" value="<?php echo $stud_ID; ?>"readonly onclick="displayMessage()">
                <input type="text" name="studName" value="<?php echo $stud_name; ?>"placeholder="Full Name" required>
                <input type="text" name="studPhone" value="<?php echo $stud_phone; ?>"placeholder="Phone" required>
                <input type="email" name="studEmail" value="<?php echo $stud_email; ?>"placeholder="Email" required>
                <input type="text" name="studSchool" value="<?php echo $stud_school; ?>"placeholder="School Name" required>
                <input type="password" name="password" placeholder="Password">

                <table>
                    <tr>
                        <td roswspan="2">
                            <button type="button" onclick="window.location.href='menu_student.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button></td>
                            <td><button type="submit" name="update" value="Update"><span class="material-symbols-outlined">update</span>Update</button></td>
                            <td><button type="submit" name="delete" value="Delete"><span class="material-symbols-outlined">delete</span>Delete</button></td>
                    </tr>
                </table>
            </form>
        </div>  
        </div>
    </div>
</body>
</html>
<script>
function displayMessage() {
    alert("This field cannot be changed.");
}
</script>
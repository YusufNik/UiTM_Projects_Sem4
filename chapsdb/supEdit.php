<?php
include("dbconn.php");
session_start();
if (!isset($_SESSION['empID'])) {
    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
    exit;
}

	$supID = $_REQUEST['sup_ID']; #receive from the link : Editsupplier.php?sup_ID=".$row["supID"]
	
	#create SQL statement to retrieve data from the supplier table
	$sql= "SELECT * FROM supplier WHERE supID= '$supID'";
	
	#execute SQL statement that assigned to the $sql variable
	$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
	
	#get the number of records from the supplier table
	$row = mysqli_num_rows($query);
	
	if($row == 0){
		echo "No record found";
	}
	else{ 
	#since the records exist in the table, 
	#then fetch the record value of each column
		$r = mysqli_fetch_assoc($query);
		$sup_ID= $r['supID'];
		$sup_name= $r['supName'];
		$sup_address= $r['supAddress'];
		$sup_state= $r['supState'];
		$sup_phone= $r['supPhone'];
        $sup_email= $r['supEmail'];
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Update Supplier</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action = "supUpDel.php" method = "post">
              
                <h1>UPDATE SUPPLIER</h1>
                <br>
                <input type="text" name="supID" value="<?php echo $sup_ID; ?>"readonly onclick="displayMessage()">
                <input type="text" name="supName" value="<?php echo $sup_name; ?>" placeholder="Supplier Name">
                <input type="text" name="supAddress" value="<?php echo $sup_address; ?>" placeholder="Address">
                <select name="supState" class="state" required>
                    <option value="Johor" <?php if ($sup_state == "Johor") echo "selected"; ?>>Johor</option>
                    <option value="Kedah" <?php if ($sup_state == "Kedah") echo "selected"; ?>>Kedah</option>
                    <option value="Kelantan" <?php if ($sup_state == "Kelantan") echo "selected"; ?>>Kelantan</option>
                    <option value="Melaka" <?php if ($sup_state == "Melaka") echo "selected"; ?>>Melaka</option>
                    <option value="Negeri Sembilan" <?php if ($sup_state == "Negeri Sembilan") echo "selected"; ?>>Negeri Sembilan</option>
                    <option value="Kuala Lumpur" <?php if ($sup_state == "Kuala Lumpur") echo "selected"; ?>>Kuala Lumpur</option>
                    <option value="Pahang" <?php if ($sup_state == "Pahang") echo "selected"; ?>>Pahang</option>
                    <option value="Pulau Pinang" <?php if ($sup_state == "Pulau Pinang") echo "selected"; ?>>Pulau Pinang</option>
                    <option value="Perak" <?php if ($sup_state == "Perak") echo "selected"; ?>>Perak</option>
                    <option value="Perlis" <?php if ($sup_state == "Perlis") echo "selected"; ?>>Perlis</option>
                    <option value="Selangor" <?php if ($sup_state == "Selangor") echo "selected"; ?>>Selangor</option>
                    <option value="Terengganu" <?php if ($sup_state == "Terengganu") echo "selected"; ?>>Terengganu</option>
                    <option value="Sarawak" <?php if ($sup_state == "Sarawak") echo "selected"; ?>>Sarawak</option>
                    <option value="Sabah" <?php if ($sup_state == "Sabah") echo "selected"; ?>>Sabah</option>
                </select>
                <input type="text" name="supPhone" value="<?php echo $sup_phone; ?>" placeholder="Phone">
                <input type="email" name="supEmail" value="<?php echo $sup_email; ?>" placeholder="Email">

                <table>
                    <tr>
                        <td roswspan="2">
                            <button  type="button" onclick="window.location.href='menu_supplier.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button></td>
                            <td><button type="submit" name="update" value="Update" class="button"><span class="material-symbols-outlined">update</span>Update</button></td>
                            <td><button type="submit" name="delete" value="Delete" class="button"><span class="material-symbols-outlined">delete</span>Delete</button></td>  
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
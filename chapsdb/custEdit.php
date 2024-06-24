<?php
include("dbconn.php");
session_start();
session_start();
if (!isset($_SESSION['empID'])) {
    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
    exit;
}
	$custID = $_REQUEST['cust_ID']; #receive from the link : EditProduct.php?cust_ID=".$row["custID"]
	
	#create SQL statement to retrieve data from the product table
	$sql= "SELECT * FROM customer WHERE custID= '$custID'";
	
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
		$cust_ID= $r['custID'];
		$cust_name= $r['custName'];
		$cust_phone= $r['custPhone'];
		$cust_address= $r['custAddress'];
        $cust_postcode= $r['custPostcode'];
		$cust_state= $r['custState'];
		$cust_email= $r['custEmail'];
        $password= $r['password'];
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Update Customer</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action = "custUpDel.php" method = "post">
              
                <h1>UPDATE CUSTOMER</h1>
                <br>
                <input type="text" name="custID" value="<?php echo $cust_ID; ?>"readonly onclick="displayMessage()" required>
                <input type="text" name="custName" value="<?php echo $cust_name; ?>" placeholder="Full Name" required>
                <input type="text" name="custPhone" value="<?php echo $cust_phone; ?>"  placeholder="Phone" required>
                <input type="text" name="custAddress" value="<?php echo $cust_address; ?>"  placeholder="Address" required>
                <input type="text" name="custPostcode" value="<?php echo $cust_postcode; ?>"  placeholder="Postcode" required> 
                <select name="custState" class="state" required>
                    <option value="Johor" <?php if ($cust_state == "Johor") echo "selected"; ?>>Johor</option>
                    <option value="Kedah" <?php if ($cust_state == "Kedah") echo "selected"; ?>>Kedah</option>
                    <option value="Kelantan" <?php if ($cust_state == "Kelantan") echo "selected"; ?>>Kelantan</option>
                    <option value="Melaka" <?php if ($cust_state == "Melaka") echo "selected"; ?>>Melaka</option>
                    <option value="Negeri Sembilan" <?php if ($cust_state == "Negeri Sembilan") echo "selected"; ?>>Negeri Sembilan</option>
                    <option value="Kuala Lumpur" <?php if ($cust_state == "Kuala Lumpur") echo "selected"; ?>>Kuala Lumpur</option>
                    <option value="Pahang" <?php if ($cust_state == "Pahang") echo "selected"; ?>>Pahang</option>
                    <option value="Pulau Pinang" <?php if ($cust_state == "Pulau Pinang") echo "selected"; ?>>Pulau Pinang</option>
                    <option value="Perak" <?php if ($cust_state == "Perak") echo "selected"; ?>>Perak</option>
                    <option value="Perlis" <?php if ($cust_state == "Perlis") echo "selected"; ?>>Perlis</option>
                    <option value="Selangor" <?php if ($cust_state == "Selangor") echo "selected"; ?>>Selangor</option>
                    <option value="Terengganu" <?php if ($cust_state == "Terengganu") echo "selected"; ?>>Terengganu</option>
                    <option value="Sarawak" <?php if ($cust_state == "Sarawak") echo "selected"; ?>>Sarawak</option>
                    <option value="Sabah" <?php if ($cust_state == "Sabah") echo "selected"; ?>>Sabah</option>
                </select>
                <input type="email" name="custEmail" value="<?php echo $cust_email; ?>" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password">
                
                <table>
                    <tr>
                        <td roswspan="2">
                            <button  type="button" onclick="window.location.href='menu_customer.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button></td>
                            <td><button type="submit" name="update" value="Update" class="button"><span class="material-symbols-outlined">update</span>Update</button></td>
                            <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
                                echo'<td><button type="submit" name="delete" value="Delete" class="button"><span class="material-symbols-outlined">delete</span>Delete</button></td>';
                            }  
                            ?>
                        </tr>
                </table>
            </form>
         </div>  
        </div>
    </div>
    </body>
</html>
</form>
<script>
function displayMessage() {
    alert("This field cannot be changed");
}
</script>
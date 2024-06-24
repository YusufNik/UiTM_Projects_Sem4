<?php
    include("dbconn.php");
    session_start();
    if (!isset($_SESSION['empID'])) {
        echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
        exit;
    }



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sup_ID= $_POST['supID'];
	$sup_name= $_POST['supName'];
	$sup_address= $_POST['supAddress'];
	$sup_state= $_POST['supState'];
	$sup_phone= $_POST['supPhone'];
	$sup_email= $_POST['supEmail'];

    // Check if adminID already exists
    $check_query = "SELECT * FROM supplier WHERE supID='$sup_ID'";
    $check_result = mysqli_query($dbconn, $check_query); //check db(current db, sql statement)

    if (mysqli_num_rows($check_result) > 0) {  //check each row (if detected consider alr existed else proceed insert)
        echo "<script>alert('Supplier ID already exists! Please choose a different ID.'); window.location= 'menu_supplier.php'</script>";
    } else {
        $sql = "INSERT INTO supplier VALUES('$sup_ID','$sup_name','$sup_address','$sup_state','$sup_phone','$sup_email')";
    }

    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        echo "<script>alert('Successfully Added!'); window.location= 'menu_supplier.php'</script>";
    } else {
        echo "<script>alert('Error! Unsuccessfully Added'); window.location= 'menu_supplier.php'</script>";
        echo "Error: " . mysqli_error($dbconn);
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
    <title>Add Supplier</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">

            <form action="supAdd.php" method="post">
                <h1>ADD NEW SUPPLIER</h1>
                <br>
                <input type="text" name="supID" placeholder="Supplier ID" required>
                <input type="text" name="supName" placeholder="Supplier Name" required>
                <input type="text" name="supAddress" placeholder="Address" required>
                <select name='supState' class='state' required>
				    <option value='' disabled selected>Choose State</option>
                    <option value='Johor'>Johor</option>
                    <option value='Kedah'>Kedah</option>
                    <option value='Kelantan'>Kelantan</option>
                    <option value='Melaka'>Melaka</option>
                    <option value='Negeri Sembilan'>Negeri Sembilan</option>
                    <option value='Kuala Lumpur'>Kuala Lumpur</option>
                    <option value='Pahang'>Pahang</option>
                    <option value='Pulau Pinang'>Pulau Pinang</option>
                    <option value='Perak'>Perak</option>
                    <option value='Perlis'>Perlis</option>
                    <option value='Selangor'>Selangor</option>
                    <option value='Terengganu'>Terengganu</option>
                    <option value='Sarawak'>Sarawak</option>
                    <option value='Sabah'>Sabah</option>
                </select>
                <input type="text" name="supPhone" placeholder="Phone" required>
                <input type="email" name="supEmail" placeholder="Email" required>
                
                <table>
                    <tr>
                        <td rowspan="2">
                            <button type="button" onclick="window.location.href='menu_supplier.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                        </td>
                        <td>
                            <button type="submit"><span class="material-symbols-outlined">inventory</span>ADD</button>
                        </td>
                    </tr>
                </table>
            </form>
         </div>
        
    </div>

</body>

</html>

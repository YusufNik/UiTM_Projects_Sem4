<?php
    include("dbconn.php");
    session_start();
    if (!isset($_SESSION['empID'])) {
        echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cust_ID = $_POST["custID"];
        $cust_Name = $_POST["custName"];
        $cust_Phone = $_POST["custPhone"];
        $cust_Address = $_POST["custAddress"];
        $cust_postcode = $_POST["custPostcode"];
        $cust_State = $_POST["custState"];
        $cust_Email = $_POST["custEmail"];
        $password = md5($_POST["password"]);   //md5

        // Check if custID already exists
        $check_query = "SELECT * FROM customer WHERE custID='$cust_ID'";
        $check_result = mysqli_query($dbconn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Username already exists! Please choose a different ID.'); window.location= 'menu_customer.php'</script>";
        } else {
            $sql = "INSERT INTO customer (custID, custName, custPhone, custAddress, custPostcode, custState, custEmail, password) 
                    VALUES ('$cust_ID', '$cust_Name', '$cust_Phone', '$cust_Address', '$cust_postcode', '$cust_State', '$cust_Email', '$password')";

            $result = mysqli_query($dbconn, $sql);

            if ($result) {
                echo "<script>alert('Successfully Added!'); window.location= 'menu_customer.php'</script>";
            } else {
                echo "<script>alert('Error! Please try again'); window.location= 'menu_customer.php'</script>";
                echo "Error: " . mysqli_error($dbconn);
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
    <title>Add Customer</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="custAdd.php" method="post"> 
                <h1>ADD NEW CUSTOMER</h1>
                <br>
                <input type="text" name="custID" placeholder="Username" required>
                <input type="text" name="custName" placeholder="Customer Name" required>
                <input type="text" name="custPhone" placeholder="Phone" required>
                <input type="text" name="custAddress" placeholder="Address" required>
                <input type="text" name="custPostcode" placeholder="Postcode" required>
                <select name='custState' class='state' required>
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
                <input type="email" name="custEmail" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password">
                <table>
                    <td rowspan="2">
                        <button type="button" onclick="window.location.href='menu_customer.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                    </td>
                    <td>
                        <button type="submit"><span class="material-symbols-outlined">person_add</span>ADD</button>
                    </td>
                </table>
            </form>
         </div>
        
        </div>
    </div>

</body>
</html>

<?php
    include("dbconn.php");
    session_start();
    if (!isset($_SESSION['empID'])) {
        echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $emp_ID= $_POST['empID'];
        $emp_name= $_POST['empName'];
        $emp_IC= $_POST['empIC'];
        $emp_phone= $_POST['empPhone'];
        $emp_email= $_POST['empEmail'];
        $emp_address= $_POST['empAddress'];
        $emp_state= $_POST['empState'];
        $emp_hire_date= $_POST['empHireDate'];
        $password= md5($_POST['password']);
    
      // Check if a new picture has been uploaded
      if (!empty($_FILES['empPic']['name'])) {
        $emp_pic_temp = $_FILES['empPic']['name'];
        $emp_pic = "image/" . $emp_pic_temp;
        // Move uploaded file to the destination directory
        if (move_uploaded_file($_FILES['empPic']['tmp_name'], $emp_pic)) {
            // File moved successfully
        } else {
            echo "<script>alert('Error uploading image file!'); window.location= 'menu_employee.php'</script>";
            exit; // Stop execution further if file upload fails
        }
    } else {
        $emp_pic = ''; // No picture uploaded
    }

    // Check if empID already exists
    $check_query = "SELECT * FROM employee WHERE empID='$emp_ID'";
    $check_result = mysqli_query($dbconn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Username already exists! Please choose a different ID.'); window.location= 'menu_employee.php'</script>";
        exit; // Stop execution further if empID already exists
    }

    // Insert new employee record
    $sql = "INSERT INTO employee (empID, empName, empIC, empPhone, empEmail, empAddress, empState, empHireDate, empPic, password) 
            VALUES ('$emp_ID', '$emp_name', '$emp_IC', '$emp_phone', '$emp_email', '$emp_address', '$emp_state', 
            '$emp_hire_date', '$emp_pic', '$password')"; // Use $emp_pic_temp instead of $emp_pic

    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        echo "<script>alert('Successfully Added!'); window.location= 'menu_employee.php'</script>";
    } else {
        echo "<script>alert('Error! Please try again'); window.location= 'menu_employee.php'</script>";
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
        <form action="empAdd.php" method="post" enctype="multipart/form-data">
            <h1>ADD NEW EMPLOYEE</h1>
            <br>
            <input type="text" name="empID" placeholder="Employee ID" required>
            <input type="text" name="empName" placeholder="Employee Name" required>
            <input type="text" name="empIC" placeholder="IC" required>
            <input type="text" name="empPhone" placeholder="Phone" required>
            <input type="email" name="empEmail" placeholder="Email" required>
            <input type="text" name="empAddress" placeholder="Address" required>
            <select name='empState' class='state' required>
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
            <input type="date" name="empHireDate" placeholder="Hire Date">
            <input type="file" name="empPic" accept="image/jpeg, image/png, image/jpg">
            <input type="password" name="password" placeholder="Password" required>
            
            <table>
                <tr>
                    <td rowspan="2">
                        <button type="button" onclick="window.location.href='menu_employee.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                    </td>
                    <td>
                        <button type="submit"><span class="material-symbols-outlined">person_add</span>ADD</button>
                    </td>
                </tr>
            </table>
        </form>
     </div>
    
</div>
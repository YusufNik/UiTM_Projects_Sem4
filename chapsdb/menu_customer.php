<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Customer</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
<?php
include("dbconn.php");
    session_start();
    if (!isset($_SESSION['empID'])) {
        echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
        exit;
    }
    if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {

        echo '<nav>';
        echo '<img src="image/logochaps.png" alt="Logo">';
        echo '<a href="menu_home.php"><span class="material-symbols-outlined">home</span>Home</a>';
        echo '<a href="menu_customer.php"><span class="material-symbols-outlined">group</span>Customer</a>';
        echo '<a href="menu_employee.php"><span class="material-symbols-outlined">badge</span>Employee</a>';
        echo '<a href="menu_product.php"><span class="material-symbols-outlined">inventory_2</span>Product</a>';
        echo '<a href="menu_supplier.php"><span class="material-symbols-outlined">local_shipping</span>Supplier</a>';
        echo '<a href="menu_PStatus.php"><span class="material-symbols-outlined">shop_two</span>Purchase Status</a>';
        echo '<a href="logout.php"><span class="material-symbols-outlined">logout</span>Logout</a>';
        echo '</nav>';
        
        echo '<div class="container" id="container">';
        echo '<div class="form-container sign-up">';
        echo '<form method="POST" action="menu_customer.php">';
    
                //if (!isset($_SESSION['adminID'])) {
                //   echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
                //   exit;
                //}

                $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
                $sql = "SELECT * FROM customer";

                if ($filter != '' && $filter != 'all') {
                    $sql .= " WHERE custState = '$filter'";
                }

                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));

                if (mysqli_num_rows($query) == 0) {
                    echo "<br><br>";
                    echo "No record found";
                    echo "<button type='submit' onclick='menu_customer.php'><span class='material-symbols-outlined'>arrow_back</span>Back</button></td>";
                } else {
                    echo "<br><br>";
                    echo "<font size='9'>List of Customer Information</font>";
                    echo "<br>";

                    if (isset($_SESSION['empName'])) {
                        if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
                            echo "<h4>Hi Admin, " . $_SESSION['empName'] . "</h4>";
                        } else {
                            echo "<h4>Hi Staff, " . $_SESSION['empName'] . "</h4>";
                        }
                    } 
                    else {
                        echo "<h4>Guest</h4>";
                    }

                    echo "<br>";
                    // Fetch subjects for the dropdown
                    $customer_sql = "SELECT custID, custState FROM customer GROUP BY custState";
                    $customer_query = mysqli_query($dbconn, $customer_sql) or die("Error: " . mysqli_error($dbconn));

                    echo "<table id='sorting'>";
                    echo "<tr>";
                    $selected_filter = isset($_POST['filter']) ? $_POST['filter'] : ''; 

                    echo "<td colspan='2'>Filter customer state according to: 
                    <select name='filter' class='option'>"; 
                      echo "<option value='' disabled selected>Choose State</option>
                        <option value='all' " . ($selected_filter == 'all' ? 'selected' : '') . ">All States</option>
                        <option value='Johor' " . ($selected_filter == 'Johor' ? 'selected' : '') . ">Johor</option>
                        <option value='Kedah' " . ($selected_filter == 'Kedah' ? 'selected' : '') . ">Kedah</option>
                        <option value='Kelantan' " . ($selected_filter == 'Kelantan' ? 'selected' : '') . ">Kelantan</option>
                        <option value='Melaka' " . ($selected_filter == 'Melaka' ? 'selected' : '') . ">Melaka</option>
                        <option value='Negeri Sembilan' " . ($selected_filter == 'Negeri Sembilan' ? 'selected' : '') . ">Negeri Sembilan</option>
                        <option value='Kuala Lumpur' " . ($selected_filter == 'Kuala Lumpur' ? 'selected' : '') . ">Kuala Lumpur</option>
                        <option value='Pahang' " . ($selected_filter == 'Pahang' ? 'selected' : '') . ">Pahang</option>
                        <option value='Pulau Pinang' " . ($selected_filter == 'Pulau Pinang' ? 'selected' : '') . ">Pulau Pinang</option>
                        <option value='Perak' " . ($selected_filter == 'Perak' ? 'selected' : '') . ">Perak</option>
                        <option value='Perlis' " . ($selected_filter == 'Perlis' ? 'selected' : '') . ">Perlis</option>
                        <option value='Selangor' " . ($selected_filter == 'Selangor' ? 'selected' : '') . ">Selangor</option>
                        <option value='Terengganu' " . ($selected_filter == 'Terengganu' ? 'selected' : '') . ">Terengganu</option>
                        <option value='Sarawak' " . ($selected_filter == 'Sarawak' ? 'selected' : '') . ">Sarawak</option>
                        <option value='Sabah' " . ($selected_filter == 'Sabah' ? 'selected' : '') . ">Sabah</option>
                    </select>";
                    echo "<button type='submit' class='custom-button'>Filter</button></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td><a href='custAdd.php' class='button2'><span class='material-symbols-outlined'>person_add </span>Add New Customer</a></td>";
                    echo "<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span>Print</a></td>";
                    echo "</tr>";
                    echo "</table>";

                    echo "<table border=1>";
                    echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Phone</th>";
                    echo "<th>Address</th>";
                    echo "<th>Postcode</th>";
                    echo "<th>State</th>";
                    echo "<th>Email</th>";
                    echo "<th>Options</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $row["custName"] . "</td>";
                        echo "<td>" . $row["custPhone"] . "</td>";
                        echo "<td>" . $row["custAddress"] . "</td>";
                        echo "<td>" . $row["custPostcode"] . "</td>";
                        echo "<td>" . $row["custState"] . "</td>";
                        echo "<td>" . $row["custEmail"] . "</td>";
                        echo "<td><a href='custEdit.php?cust_ID=" . $row["custID"] . "' class='button2'><span class='material-symbols-outlined'>Edit</span>Edit</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                
            echo'</form>';
        echo'</div>';
    echo'</div>';
    }
    else {
        echo '<nav>';
        echo '<img src="image/logochaps.png" alt="Logo">';
        echo '<a href="menu_homeS.php"><span class="material-symbols-outlined">home</span>Home</a>';
        echo '<a href="menu_customer.php"><span class="material-symbols-outlined">group</span>Customer</a>';
        echo '<a href="menu_product.php"><span class="material-symbols-outlined">inventory_2</span>Product</a>';
        echo '<a href="menu_PStatus.php"><span class="material-symbols-outlined">shop_two</span>Purchase Status</a>';
        echo '<a href="empEdit2.php?emp_ID=' . $_SESSION['empID'] . '"><span class="material-symbols-outlined">update</span>Update Profile</a>';
        echo '<a href="logout.php"><span class="material-symbols-outlined">logout</span>Logout</a>';
        echo '</nav>';

        echo '<div class="container" id="container">';
        echo '<div class="form-container sign-up">';
        echo '<form method="POST" action="menu_customer.php">';
    
                //if (!isset($_SESSION['adminID'])) {
                //   echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
                //   exit;
                //}

                $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
                $sql = "SELECT * FROM customer";

                if ($filter != '' && $filter != 'all') {
                    $sql .= " WHERE custState = '$filter'";
                }

                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));

                if (mysqli_num_rows($query) == 0) {
                    echo "<br><br>";
                    echo "No record found";
                    echo "<button type='submit' onclick='menu_customer.php'><span class='material-symbols-outlined'>arrow_back</span>Back</button></td>";
                } else {
                    echo "<br><br>";
                    echo "<font size='9'>List of Customer Information</font>";
                    echo "<br>";

                    if (isset($_SESSION['empName'])) {
                        if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
                            echo "<h4>Hi Admin, " . $_SESSION['empName'] . "</h4>";
                        } else {
                            echo "<h4>Hi Staff, " . $_SESSION['empName'] . "</h4>";
                        }
                    } 
                    else {
                        echo "<h4>Guest</h4>";
                    }

                    echo "<br>";
                    // Fetch subjects for the dropdown
                    $customer_sql = "SELECT custID, custState FROM customer GROUP BY custState";
                    $customer_query = mysqli_query($dbconn, $customer_sql) or die("Error: " . mysqli_error($dbconn));

                    echo "<table id='sorting'>";
                    echo "<tr>";
                    $selected_filter = isset($_POST['filter']) ? $_POST['filter'] : ''; 

                    echo "<td colspan='2'>Filter customer state according to: 
                    <select name='filter' class='option'>"; 
                      echo "<option value='' disabled selected>Choose State</option>
                        <option value='all' " . ($selected_filter == 'all' ? 'selected' : '') . ">All States</option>
                        <option value='Johor' " . ($selected_filter == 'Johor' ? 'selected' : '') . ">Johor</option>
                        <option value='Kedah' " . ($selected_filter == 'Kedah' ? 'selected' : '') . ">Kedah</option>
                        <option value='Kelantan' " . ($selected_filter == 'Kelantan' ? 'selected' : '') . ">Kelantan</option>
                        <option value='Melaka' " . ($selected_filter == 'Melaka' ? 'selected' : '') . ">Melaka</option>
                        <option value='Negeri Sembilan' " . ($selected_filter == 'Negeri Sembilan' ? 'selected' : '') . ">Negeri Sembilan</option>
                        <option value='Kuala Lumpur' " . ($selected_filter == 'Kuala Lumpur' ? 'selected' : '') . ">Kuala Lumpur</option>
                        <option value='Pahang' " . ($selected_filter == 'Pahang' ? 'selected' : '') . ">Pahang</option>
                        <option value='Pulau Pinang' " . ($selected_filter == 'Pulau Pinang' ? 'selected' : '') . ">Pulau Pinang</option>
                        <option value='Perak' " . ($selected_filter == 'Perak' ? 'selected' : '') . ">Perak</option>
                        <option value='Perlis' " . ($selected_filter == 'Perlis' ? 'selected' : '') . ">Perlis</option>
                        <option value='Selangor' " . ($selected_filter == 'Selangor' ? 'selected' : '') . ">Selangor</option>
                        <option value='Terengganu' " . ($selected_filter == 'Terengganu' ? 'selected' : '') . ">Terengganu</option>
                        <option value='Sarawak' " . ($selected_filter == 'Sarawak' ? 'selected' : '') . ">Sarawak</option>
                        <option value='Sabah' " . ($selected_filter == 'Sabah' ? 'selected' : '') . ">Sabah</option>
                    </select>";
                    echo "<button type='submit' class='custom-button'>Filter</button></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td><a href='custAdd.php' class='button2'><span class='material-symbols-outlined'>person_add </span>Add New Customer</a></td>";
                    echo "</tr>";
                    echo "</table>";

                    echo "<table border=1>";
                    echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Phone</th>";
                    echo "<th>Address</th>";
                    echo "<th>Postcode</th>";
                    echo "<th>State</th>";
                    echo "<th>Email</th>";
                    echo "<th>Options</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $row["custName"] . "</td>";
                        echo "<td>" . $row["custPhone"] . "</td>";
                        echo "<td>" . $row["custAddress"] . "</td>";
                        echo "<td>" . $row["custPostcode"] . "</td>";
                        echo "<td>" . $row["custState"] . "</td>";
                        echo "<td>" . $row["custEmail"] . "</td>";
                        echo "<td><a href='custEdit.php?cust_ID=" . $row["custID"] . "' class='button2'><span class='material-symbols-outlined'>Edit</span>Edit</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                
            echo'</form>';
        echo'</div>';
    echo'</div>';
    }
?>
</body>

</html>

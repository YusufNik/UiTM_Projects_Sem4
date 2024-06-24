<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Employee</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <nav>
        <img src="image/logochaps.png">
        <a href="menu_home.php"><span class='material-symbols-outlined'>home</span>Home</a>
        <a href="menu_customer.php"><span class='material-symbols-outlined'>group</span>Customer</a>
        <a href="menu_employee.php"><span class='material-symbols-outlined'>badge</span>Employee</a>
        <a href="menu_product.php"><span class='material-symbols-outlined'>inventory_2</span>Product</a>
        <a href="menu_supplier.php"><span class='material-symbols-outlined'>local_shipping</span>Supplier</a>
        <a href="menu_PStatus.php"><span class='material-symbols-outlined'>shop_two</span>Purchase Status</a>
        <a href="logout.php"><span class='material-symbols-outlined'>logout</span>Logout</a>
    </nav>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST"> <!-- Ensure method is set to POST -->
                <?php
                include("dbconn.php");
                session_start();
                if (!isset($_SESSION['empID'])) {
                    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
                    exit;
                }
                $sql = "SELECT * FROM employee";
                $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

                if ($filter != '' && $filter != 'all') {
                    // Extract the year from the selected filter value
                    $year = substr($filter, 0, 4); // Assuming the format is YYYY-MM-DD
                    $sql .= " WHERE YEAR(empHireDate) = '$year'";
                }

                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
                $row_count = mysqli_num_rows($query);

                if (mysqli_num_rows($query) == 0) {
                    echo "<br><br>";
                    echo "No record found";
                    echo "<button type='submit' onclick='menu_employee.php'><span class='material-symbols-outlined'>arrow_back</span>Back</button></td>";
                } else {
                    echo "<br><br>";
                    echo "<font size='9'>List of Employee Information</font>";
                    echo "<br>";

                if (isset($_SESSION['empName'])) {
                    if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
                        echo "<h4>Hi Admin, " . $_SESSION['empName'] . "</h4>";
                    } else {
                        echo "<h4>Hi Staff, " . $_SESSION['empName'] . "</h4>";
                    }
                } else {
                    echo "<h4>Guest</h4>";
                }

                echo '<br>';

                // Display the filter dropdown and button
                echo "<table id='sorting'>";
                echo "<tr>";
                echo "<td colspan='2'>Filter employee hire year according to: 
                    <select name='filter' class='option'>"; 
                echo "<option value='' disabled selected>Choose Year</option>
                      <option value='all' " . ($filter == 'all' ? 'selected' : '') . ">All Years</option>
                      <option value='2021' " . ($filter == '2021' ? 'selected' : '') . ">2021</option>
                      <option value='2022' " . ($filter == '2022' ? 'selected' : '') . ">2022</option>
                      <option value='2023' " . ($filter == '2023' ? 'selected' : '') . ">2023</option>
                      <option value='2024' " . ($filter == '2024' ? 'selected' : '') . ">2024</option>
                    </select>";
                echo "<button type='submit' class='custom-button'>Filter</button></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td><a href='empAdd.php' class='button2'><span class='material-symbols-outlined'>account_circle</span> Add New Employee</a></td>";
                echo "<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span> Print</a></td>";
                echo "</tr>";
                echo "</table>";

                // Display the table of employee information
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Phone</th>";
                echo "<th>Email</th>";
                echo "<th>State</th>";
                echo "<th>Hire Date</th>";
                echo "<th>Picture</th>";
                echo "<th>Options</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>" . $row["empName"] . "</td>";
                    echo "<td>" . $row["empPhone"] . "</td>";
                    echo "<td>" . $row["empEmail"] . "</td>";
                    echo "<td>" . $row["empState"] . "</td>";
                    echo "<td>" . $row["empHireDate"] . "</td>";
                    echo "<td><img src='" . $row["empPic"] . "' alt='Staff Picture' style='max-width: 100px; height: 70px;'></td>";
                    echo "<td><a href='empEdit.php?emp_ID=" . $row["empID"] . "' class='button2'><span class='material-symbols-outlined'>Edit</span> Edit</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
                ?>
            </form>
        </div>
    </div>

</body>

</html>

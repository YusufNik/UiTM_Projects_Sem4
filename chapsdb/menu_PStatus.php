<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Purchase and Status</title>
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
        echo '<form method="POST" action="menu_PStatus.php">';
                
                // Query to fetch all data from purchase table
                $sql = "SELECT p.purID, p.purOrderDate, p.purShipDate, p.purStatus, SUM(pp.qty) as totalQty
                        FROM purchase p
                        JOIN purchase_product pp ON p.purID = pp.purID";

                $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

                if ($filter != '' && $filter != 'all') {
                    $sql .= " WHERE p.purStatus = '$filter'";
                }

                $sql .= " GROUP BY p.purID, p.purOrderDate, p.purShipDate, p.purStatus";

                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
                $row_count = mysqli_num_rows($query);

                if (mysqli_num_rows($query) == 0) {
                    echo "<br><br>";
                    echo "No record found";
                    echo "<button type='submit' onclick='menu_PStatus.php'><span class='material-symbols-outlined'>arrow_back</span>Back</button></td>";
                } else {
                    echo "<br><br>";
                    echo "<font size='9'>List of Purchase Product Information</font>";
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

                // Dropdown for filtering by shipment status
                echo "<table id='sorting'>";
                echo "<tr>";
                echo "<td colspan='2'>Filter shipment status: 
                        <select name='filter' class='option'>";
                echo "<option value='' " . ($filter == '' ? 'selected' : '') . ">Select Status</option>";
                echo "<option value='all' " . ($filter == 'all' ? 'selected' : '') . ">All Status</option>";

                // Fetch shipment statuses from database for dropdown
                $status_sql = "SELECT purStatus FROM purchase GROUP BY purStatus"; 
                $status_query = mysqli_query($dbconn, $status_sql) or die("Error: " . mysqli_error($dbconn));

                while ($status = mysqli_fetch_assoc($status_query)) {
                    $selected = ($status['purStatus'] == $filter) ? "selected" : "";
                    echo "<option value='" . $status['purStatus'] . "' $selected>" . $status['purStatus'] . "</option>";
                }

                echo "</select>";
                echo "<button type='submit' class='custom-button'>Filter</button></td>";
                echo "</tr>";
                echo "<tr>";
                if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
                    echo "<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span>Print</a></td>";
                }
                echo "</tr>";
                echo "</table>";

                // Displaying the table of purchase information
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Purchase ID</th>";
                echo "<th>Order Date</th>";
                echo "<th>Shipment Date</th>";
                echo "<th>Status</th>";
                echo "<th>Item Quantity</th>";
                echo "<th>Options</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>" . $row["purID"] . "</td>";
                    echo "<td>" . $row["purOrderDate"] . "</td>";
                    echo "<td>" . $row["purShipDate"] . "</td>";
                    echo "<td>" . $row["purStatus"] . "</td>";
                    echo "<td>" . $row["totalQty"] . "</td>";
                    echo "<td>";
                    echo "<a href='purchaseDetails.php?pur_ID=" . $row["purID"] . "' class='button2'><span class='material-symbols-outlined'>info</span>Details</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                }
             
            echo'</form>';
        echo'</div>';
     echo'</div>';
      }
    else{
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
        echo '<form method="POST" action="menu_PStatus.php">';
                
                // Query to fetch all data from purchase table
                $sql = "SELECT p.purID, p.purOrderDate, p.purShipDate, p.purStatus, SUM(pp.qty) as totalQty
                        FROM purchase p
                        JOIN purchase_product pp ON p.purID = pp.purID";

                $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

                if ($filter != '' && $filter != 'all') {
                    $sql .= " WHERE p.purStatus = '$filter'";
                }

                $sql .= " GROUP BY p.purID, p.purOrderDate, p.purShipDate, p.purStatus";

                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
                $row_count = mysqli_num_rows($query);

                if (mysqli_num_rows($query) == 0) {
                    echo "<br><br>";
                    echo "No record found";
                    echo "<button type='submit' onclick='menu_PStatus.php'><span class='material-symbols-outlined'>arrow_back</span>Back</button></td>";
                } else {
                    echo "<br><br>";
                    echo "<font size='9'>List of Purchase Product Information</font>";
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

                // Dropdown for filtering by shipment status
                echo "<table id='sorting'>";
                echo "<tr>";
                echo "<td colspan='2'>Filter shipment status: 
                        <select name='filter' class='option'>";
                echo "<option value='' " . ($filter == '' ? 'selected' : '') . ">Select Status</option>";
                echo "<option value='all' " . ($filter == 'all' ? 'selected' : '') . ">All Status</option>";

                // Fetch shipment statuses from database for dropdown
                $status_sql = "SELECT purStatus FROM purchase GROUP BY purStatus"; 
                $status_query = mysqli_query($dbconn, $status_sql) or die("Error: " . mysqli_error($dbconn));

                while ($status = mysqli_fetch_assoc($status_query)) {
                    $selected = ($status['purStatus'] == $filter) ? "selected" : "";
                    echo "<option value='" . $status['purStatus'] . "' $selected>" . $status['purStatus'] . "</option>";
                }

                echo "</select>";
                echo "<button type='submit' class='custom-button'>Filter</button></td>";
                echo "</tr>";
                echo "</table>";

                // Displaying the table of purchase information
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Purchase ID</th>";
                echo "<th>Order Date</th>";
                echo "<th>Shipment Date</th>";
                echo "<th>Status</th>";
                echo "<th>Item Quantity</th>";
                echo "<th>Options</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>" . $row["purID"] . "</td>";
                    echo "<td>" . $row["purOrderDate"] . "</td>";
                    echo "<td>" . $row["purShipDate"] . "</td>";
                    echo "<td>" . $row["purStatus"] . "</td>";
                    echo "<td>" . $row["totalQty"] . "</td>";
                    echo "<td>";
                    echo "<a href='purchaseDetails.php?pur_ID=" . $row["purID"] . "' class='button2'><span class='material-symbols-outlined'>info</span>Details</a>";
                    echo "</td>";
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

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Product</title>
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
        echo '<form method="POST" action="menu_product.php">';
     
    
                $sql = "SELECT * FROM product";
                $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

                if ($filter != '' && $filter != 'all') {
                    $sql .= " WHERE prodCat = '$filter'";
                }

                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
                $row_count = mysqli_num_rows($query);

                if (mysqli_num_rows($query) == 0) {
                    echo "<br><br>";
                    echo "No record found";
                    echo "<button type='submit' onclick='menu_product.php'><span class='material-symbols-outlined'>arrow_back</span>Back</button></td>";
                } else {
                    echo "<br><br>";
                    echo "<font size='9'>List of Product Information</font>";
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

                // Dropdown for filtering by product category
                echo "<table id='sorting'>";
                echo "<tr>";
                echo "<td colspan='2'>Filter product category: 
                        <select name='filter' class='option'>";
                echo "<option value='' " . ($filter == '' ? 'selected' : '') . ">Select Category</option>";
                echo "<option value='all' " . ($filter == 'all' ? 'selected' : '') . ">All Categories</option>";

                // Fetch product categories from database for dropdown
                $product_sql = "SELECT DISTINCT prodCat FROM product"; // Use DISTINCT to avoid duplicate categories
                $product_query = mysqli_query($dbconn, $product_sql) or die("Error: " . mysqli_error($dbconn));
                
                while ($product = mysqli_fetch_assoc($product_query)) {
                    $selected = ($product['prodCat'] == $filter) ? "selected" : "";
                    echo "<option value='" . $product['prodCat'] . "' $selected>" . $product['prodCat'] . "</option>";
                }

                echo "</select>";
                echo "<button type='submit' class='custom-button'>Filter</button></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td><a href='prodAdd.php' class='button2'><span class='material-symbols-outlined'>inventory_2</span>Add New Product</a></td>";
                echo "<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span>Print</a></td>";
                echo "</tr>";
                echo "</table>";

                // Display product list table
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Brand</th>";
                echo "<th>Price (RM)</th>";
                echo "<th>Category</th>";
                echo "<th>Picture</th>";
                echo "<th>Options</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>" . $row["prodName"] . "</td>";
                    echo "<td>" . $row["prodBrand"] . "</td>";
                    echo "<td>" . $row["prodPrice"] . "</td>";
                    echo "<td>" . $row["prodCat"] . "</td>";
                    echo "<td><img src='" . $row["prodPic"] . "' alt='Product Picture' style='max-width: 100px; height: 70px;'></td>";
                    echo "<td><a href='prodEdit.php?prod_ID=" . $row["prodID"] . "' class='button2'><span class='material-symbols-outlined'>Edit</span>Edit</td>";
                    echo "</tr>";
                }
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
        echo '<form method="POST" action="menu_product.php">';
     
    
                $sql = "SELECT * FROM product";
                $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

                if ($filter != '' && $filter != 'all') {
                    $sql .= " WHERE prodCat = '$filter'";
                }

                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
                $row_count = mysqli_num_rows($query);

                if (mysqli_num_rows($query) == 0) {
                    echo "<br><br>";
                    echo "No record found";
                    echo "<button type='submit' onclick='menu_product.php'><span class='material-symbols-outlined'>arrow_back</span>Back</button></td>";
                } else {
                    echo "<br><br>";
                    echo "<font size='9'>List of Product Information</font>";
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

                // Dropdown for filtering by product category
                echo "<table id='sorting'>";
                echo "<tr>";
                echo "<td colspan='2'>Filter product category: 
                        <select name='filter' class='option'>";
                echo "<option value='' " . ($filter == '' ? 'selected' : '') . ">Select Category</option>";
                echo "<option value='all' " . ($filter == 'all' ? 'selected' : '') . ">All Categories</option>";

                // Fetch product categories from database for dropdown
                $product_sql = "SELECT DISTINCT prodCat FROM product"; // Use DISTINCT to avoid duplicate categories
                $product_query = mysqli_query($dbconn, $product_sql) or die("Error: " . mysqli_error($dbconn));
                
                while ($product = mysqli_fetch_assoc($product_query)) {
                    $selected = ($product['prodCat'] == $filter) ? "selected" : "";
                    echo "<option value='" . $product['prodCat'] . "' $selected>" . $product['prodCat'] . "</option>";
                }

                echo "</select>";
                echo "<button type='submit' class='custom-button'>Filter</button></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span>Print</a></td>";
                echo "</tr>";
                echo "</table>";

                // Display product list table
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Brand</th>";
                echo "<th>Price (RM)</th>";
                echo "<th>Category</th>";
                echo "<th>Picture</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>" . $row["prodName"] . "</td>";
                    echo "<td>" . $row["prodBrand"] . "</td>";
                    echo "<td>" . $row["prodPrice"] . "</td>";
                    echo "<td>" . $row["prodCat"] . "</td>";
                    echo "<td><img src='" . $row["prodPic"] . "' alt='Product Picture' style='max-width: 100px; height: 70px;'></td>";
                    echo "</tr>";
                }
            }
                
            echo'</form>';
        echo'</div>';
    echo'</div>';
    }
    ?>
</body>

</html>

<!DOCTYPE html>
    <html>

    <head>
        <meta vharset = "UTF-8">
        <title>Supplier</title>
        <link rel = "stylesheet" href = "style2.css">
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
        </link>
        <div class="container" id="container">
            <div class="form-container sign-up">
                <form>
                    
                <?php
                    include("dbconn.php");
                    session_start();
                    if (!isset($_SESSION['empID'])) {
                        echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
                        exit;
                    }
                    $sql="select * from supplier";
                    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
                    $row = mysqli_num_rows($query);
                    if($row == 0){
                        echo "No record found";
                    }
                    else{
                        echo"<br>";
                        echo"<br>";
                        echo"<font size='9'>List of Supplier Information</font>";
                        echo"<br>";
                        if (isset($_SESSION['empName'])) {
                            echo "<h4>Hi, " . $_SESSION['empName'] . "</h4>";
                        } else {
                            echo "<h4>Guest</h4>"; // Display a fallback if the employee name is not set
                        }
                        echo '<br>';

                        echo "<table id='sorting'>";
                        echo"<td><a href='supAdd.php' class='button2'><span class='material-symbols-outlined'>inventory</span>Add New Supplier</a></td>";
                        echo "<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span>Print</a></td></tr>";
                        echo "</table>";

		                echo"<table border=1>";
                        echo"<tr>";
                        echo"<th>Name</th>";
                        echo"<th>Address</th>";
                        echo"<th>State</th>";
                        echo"<th>Phone</th>";
                        echo"<th>Email</th>";
                        echo"<th>Options</th>";
                        echo"</tr>";
                        
                        while($row = mysqli_fetch_array($query)) {
                        echo"<tr>";
                        echo"<td>".$row["supName"]."</td>";
                        echo"<td>".$row["supAddress"]."</td>";
                        echo"<td>".$row["supState"]."</td>";
                        echo"<td>".$row["supPhone"]."</td>";
                        echo"<td>".$row["supEmail"]."</td>";
                        echo"<td><a href='supEdit.php?sup_ID=".$row["supID"]."' class='button2'><span class='material-symbols-outlined'>Edit</span>Edit</td>";
                        echo"</tr>";
                        }
                    }	
                    ?>
    
                </form>
            </div>
   

    </body>
    </html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
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
    </nav>
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
                            echo "<br>";
                            echo "<br>";
                            echo "<center><font size='6'>Welcome to Computer Hardware Management System (CHAPS)!</font></center>";
                            echo "<br>";
                            echo "<br>";
    
                            // Check if the employee is logged in and the session variable is set
                            if (isset($_SESSION['empName'])) {
                                echo "<h4>Hi Admin, " . $_SESSION['empName'] . "</h4>";
                            } else {
                                echo "<h4>Guest</h4>"; // Display a fallback if the employee name is not set
                            }  
                        ?>
                        <br>
                        <img src="image/banner2.jpg" class="promo" alt="promo">
                    </form>
            <table id="hide">
            <tr>
                <td><a href='bizSummary.php?empID=".$row["empID"]."' class='button2'><span class='material-symbols-outlined'>attach_money</span>See Business Summary</a></td>
            </tr>
        </table>
        </div>
    </div>
</body>
</html>

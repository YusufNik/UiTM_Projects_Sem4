<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Details</title>
    <link rel="stylesheet" href="style5.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="purchaseDetailsUp.php" method="POST">
                <?php
                include("dbconn.php");
                session_start();
                if (!isset($_SESSION['empID'])) {
                    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
                    exit;
                }

                if (isset($_GET['pur_ID'])) {
                    $pur_ID = $_GET['pur_ID'];

                    // Query to fetch purchase details
                    $sql = "SELECT p.purID, p.purOrderDate, p.purShipDate, p.purStatus, c.custName, e.empName
                            FROM purchase p
                            LEFT JOIN customer c ON p.custID = c.custID
                            LEFT JOIN employee e ON p.empID = e.empID
                            WHERE p.purID = '$pur_ID'";
                    
                    $result = mysqli_query($dbconn, $sql);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row) {
                            $purID = $row['purID'];
                            $orderDate = $row['purOrderDate'];
                            $shipDate = $row['purShipDate'];
                            $status = $row['purStatus'];
                            $custName = $row['custName'];
                            $empName = $row['empName'];

                            // Display purchase details
                            echo "<h2 class='title'>Purchase Details</h2>";
                            echo "<br>";
                            echo "<br>";
                            echo "<div class='form-row'><label for='purID'>Purchase ID:</label><input type='text' id='purID' name='purID' value='$purID' readonly></div>";
                            echo "<div class='form-row'><label for='orderDate'>Order Date:</label><input type='text' id='orderDate' name='orderDate' value='$orderDate' readonly></div>";
                            echo "<div class='form-row'><label for='shipDate'>Shipment Date:</label><input type='date' id='shipDate' name='shipDate' value='$shipDate'></div>";
                            echo "<div class='form-row'><label for='status'>Status:</label><select id='status' name='status'>";
                            echo "<option value='Pending' " . ($status == 'Pending' ? 'selected' : '') . ">Pending</option>";
                            echo "<option value='Shipped' " . ($status == 'Shipped' ? 'selected' : '') . ">Shipped</option>";
                            echo "<option value='Delivered' " . ($status == 'Delivered' ? 'selected' : '') . ">Delivered</option>";
                            echo "</select></div>";
                            echo "<div class='form-row'><label for='custName'>Customer Name:</label><input type='text' id='custName' name='custName' value='$custName' readonly></div>";
                            echo "<div class='form-row'><label for='empName'>Employee Name:</label><input type='text' id='empName' name='empName' value='$empName' readonly></div>";

                            // Query to fetch products in the purchase
                            $sql_products = "SELECT pp.prodID, prodName, prodPrice, qty, price 
                                            FROM purchase_product pp 
                                            JOIN product p ON pp.prodID = p.prodID 
                                            WHERE purID = '$pur_ID'";
                            $result_products = mysqli_query($dbconn, $sql_products);

                            if ($result_products && mysqli_num_rows($result_products) > 0) {
                                echo "<br>";
                                echo "<h2 class='title'>Products in Purchase</h2>";
                                echo "<br>";
                                echo "<table class='styled-table'>";
                                echo "<thead><tr>";
                                echo "<th>Product ID</th>";
                                echo "<th>Product Name</th>";
                                echo "<th>Quantity</th>";
                                echo "<th>Price per Unit</th>";
                                echo "<th>Total Price</th>";
                                echo "</tr></thead><tbody>";

                                $totalPrice = 0;

                                while ($row_product = mysqli_fetch_assoc($result_products)) {
                                    $prodID = $row_product['prodID'];
                                    $prodName = $row_product['prodName'];
                                    $qty = $row_product['qty'];
                                    $price = $row_product['prodPrice'];
                                    $totalProductPrice = $row_product['price'];
                                    $totalPrice += $totalProductPrice;

                                    echo "<tr>";
                                    echo "<td>$prodID</td>";
                                    echo "<td>$prodName</td>";
                                    echo "<td>$qty</td>";
                                    echo "<td>RM $price</td>";
                                    echo "<td>RM $totalProductPrice</td>";
                                    echo "</tr>";
                                }
                                echo "<tr>";
                                echo "<td colspan='4' style='text-align: right;'><strong>Total Price:</strong></td>";
                                echo '<td><strong>RM ' . number_format($totalPrice, 2) . '</strong></td>';
                                echo "</tr>";
                                echo "</tbody></table>";
                            } else {
                                echo "<p>No products found for this purchase.</p>";
                            }

                            // Query to fetch payment details
                            $sql_payment = "SELECT payID, amount, payDate, accNum, bankName 
                                            FROM payment 
                                            WHERE purID = '$pur_ID'";
                            $result_payment = mysqli_query($dbconn, $sql_payment);

                            if ($result_payment && mysqli_num_rows($result_payment) > 0) {
                                echo "<h2 class='title'>Payment Details</h2>";
                                echo "<br>";
                                echo "<table class='styled-table'>";
                                echo "<thead><tr>";
                                echo "<th>Payment ID</th>";
                                echo "<th>Amount</th>";
                                echo "<th>Payment Date</th>";
                                echo "<th>Account Number</th>";
                                echo "<th>Bank Name</th>";
                                echo "</tr></thead><tbody>";

                                while ($row_payment = mysqli_fetch_assoc($result_payment)) {
                                    echo "<tr>";
                                    echo "<td>" . $row_payment['payID'] . "</td>";
                                    echo "<td>" . $row_payment['amount'] . "</td>";
                                    echo "<td>" . $row_payment['payDate'] . "</td>";
                                    echo "<td>" . $row_payment['accNum'] . "</td>";
                                    echo "<td>" . $row_payment['bankName'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody></table>";
                            } else {
                                echo "<p>No payment details found.</p>";
                            }

                            // Add hidden field for purID to submit the form
                            echo "<input type='hidden' id='purID' name='purID' value='$purID'>";

                            // Submit button
                            echo '<table style="margin: 0 auto;">'; // Center the table
                            echo "<tr>";
                            echo '<td><a href="menu_PStatus.php" class="button2"><span class="material-symbols-outlined">arrow_back</span> Back</a></td>';
                            if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
                                echo '<td><a href="#" onclick="window.print()" class="button2"><span class="material-symbols-outlined">print</span>Print</a></td>';
                            }
                                echo '<td><button type="submit" name="update" value="Update" class="button2"><span class="material-symbols-outlined">update</span> Update</button></td>';
                            echo "</tr>";
                            echo "</table>";


                        } else {
                            echo "<p>No purchase found with the ID: $pur_ID</p>";
                        }
                    } else {
                        echo "<p>Error fetching purchase details: " . mysqli_error($dbconn) . "</p>";
                    }
                } else {
                    echo "<p>No purchase ID specified.</p>";
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>

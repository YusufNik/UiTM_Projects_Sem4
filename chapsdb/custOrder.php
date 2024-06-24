<?php
session_start();
include("dbconn.php");

if (!isset($_SESSION['custID'])) {
    header("Location: login.html");
    exit();
}

$custID = $_SESSION['custID'];

if (isset($_GET['purID'])) {
    $purID = $_GET['purID'];

    $orderQuery = "SELECT * FROM purchase WHERE purID = '$purID' AND custID = '$custID'";
    $orderResult = mysqli_query($dbconn, $orderQuery);
    $order = mysqli_fetch_assoc($orderResult);

    $productQuery = "SELECT p.prodID, p.prodName, p.prodBrand, pp.qty, pp.price 
                     FROM purchase_product pp
                     JOIN product p ON pp.prodID = p.prodID
                     WHERE pp.purID = '$purID'";
    $productResult = mysqli_query($dbconn, $productQuery);

    $paymentQuery = "SELECT * FROM payment WHERE purID = '$purID'";
    $paymentResult = mysqli_query($dbconn, $paymentQuery);
    $payment = mysqli_fetch_assoc($paymentResult);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="style7.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <nav>
        <div class="nav-left">
            <img src="image/logochaps.png" alt="Logo">
        </div>
        <div class="nav-center">
            <h4>Hi, <?php echo $_SESSION['custName']; ?></h4>
        </div>
        <div class="nav-right">
            <a href="menu_catalog.php"><span class="material-symbols-outlined">home</span>Home</a>
            <a href="customerCart.php"><span class="material-symbols-outlined">shopping_cart</span>Cart</a>
            <a href="custOrder.php"><span class="material-symbols-outlined">local_shipping</span>Your Order</a>
            <a href="custUpProfile.php?cust_ID=<?php echo $_SESSION['custID']; ?>"><span class="material-symbols-outlined">update</span>Update Profile</a>
            <a href="logout.php"><span class="material-symbols-outlined">logout</span>Logout</a>
        </div>
    </nav>
    <div class="container">
        <h1>Your Orders</h1>
        <div class="order-list">
            <?php
            $orderHistoryQuery = "SELECT * FROM purchase WHERE custID = '$custID'";
            $orderHistoryResult = mysqli_query($dbconn, $orderHistoryQuery);

            if (mysqli_num_rows($orderHistoryResult) > 0) {
                while ($orderHistory = mysqli_fetch_assoc($orderHistoryResult)) {
                    echo '<div class="order">';
                    echo '<p>Order ID: ' . $orderHistory['purID'] . '</p>';
                    echo '<p>Order Date: ' . $orderHistory['purOrderDate'] . '</p>';
                    echo '<p>Status: ' . $orderHistory['purStatus'] . '</p>';
                    echo '<button class="button toggle-details" data-id="' . $orderHistory['purID'] . '">View Details</button>';
                    echo '<div class="order-details" id="details-' . $orderHistory['purID'] . '">';
                    
                    $purID = $orderHistory['purID'];
                    
                    // Fetch order details
                    $orderQuery = "SELECT * FROM purchase WHERE purID = '$purID' AND custID = '$custID'";
                    $orderResult = mysqli_query($dbconn, $orderQuery);
                    $order = mysqli_fetch_assoc($orderResult);

                    $productQuery = "SELECT p.prodID, p.prodName, p.prodBrand, p.prodPrice, pp.qty, pp.price, p.prodPic 
                                     FROM purchase_product pp
                                     JOIN product p ON pp.prodID = p.prodID
                                     WHERE pp.purID = '$purID'";
                    $productResult = mysqli_query($dbconn, $productQuery);

                    $paymentQuery = "SELECT * FROM payment WHERE purID = '$purID'";
                    $paymentResult = mysqli_query($dbconn, $paymentQuery);
                    $payment = mysqli_fetch_assoc($paymentResult);
                    
                    echo '<h3>Order Details</h3>';
                    echo '<p><strong>Order ID:</strong> ' . $order['purID'] . '</p>';
                    echo '<p><strong>Order Date:</strong> ' . $order['purOrderDate'] . '</p>';
                    echo '<p><strong>Shipment Date:</strong> ' . $order['purShipDate'] . '</p>';
                    echo '<p><strong>Status:</strong> ' . $order['purStatus'] . '</p>';

                    echo '<h3>Products in Purchase</h3>';
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Product</th>';
                    echo '<th>Name</th>';
                    echo '<th>Brand</th>';
                    echo '<th>Quantity</th>';
                    echo '<th>Price</th>';
                    echo '</tr>';
                    $totalPrice = 0;
                    while ($product = mysqli_fetch_assoc($productResult)) {
                        $totalPrice += $product['qty'] * $product['prodPrice'];
                        echo '<tr>';
                        echo '<td><img src="' . $product['prodPic'] . '" alt="' . $product['prodName'] . '" style="width:100px; height:auto;"></td>';
                        echo '<td>' . $product['prodName'] . '</td>';
                        echo '<td>' . $product['prodBrand'] . '</td>';
                        echo '<td>' . $product['qty'] . '</td>';
                        echo '<td>RM ' . $product['price'] . '</td>';
                        echo '</tr>';
                    }
                    echo '<tr>';
                    echo '<td colspan="4" style="text-align: right;"><strong>Total Price:</strong></td>';
                    echo '<td><strong>RM ' . number_format($totalPrice, 2) . '</strong></td>';
                    echo '</tr>';
                    echo '</table>';

                    echo '<h3>Payment Details</h3>';
                    echo '<p><strong>Payment ID:</strong> ' . $payment['payID'] . '</p>';
                    echo '<p><strong>Amount:</strong> RM ' . $payment['amount'] . '</p>';
                    echo '<p><strong>Bank Name:</strong> ' . $payment['bankName'] . '</p>';
                    echo '<p><strong>Account Number:</strong> ' . $payment['accNum'] . '</p>';
                    echo '<p><strong>Payment Date:</strong> ' . $payment['payDate'] . '</p>';
                    
                    echo '</div>'; // Close order-details
                    echo '</div>'; // Close order
                }
            } else {
                echo '<p>No orders found!</p>';
            }
            ?>
        </div>
    </div>
    <script>
        document.querySelectorAll('.toggle-details').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-id');
                const details = document.getElementById('details-' + orderId);
                if (details.style.display === 'none' || details.style.display === '') {
                    details.style.display = 'block';
                    this.textContent = 'Hide Details';
                } else {
                    details.style.display = 'none';
                    this.textContent = 'View Details';
                }
            });
        });
    </script>
</body>
</html>

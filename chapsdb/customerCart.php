<?php
session_start();

if (!isset($_SESSION['custID'])) {
    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $product = array(
        'prodID' => $_POST['prodID'],
        'prodName' => $_POST['prodName'],
        'prodPrice' => $_POST['prodPrice'],
        'quantity' => 1
    );

    $product_exists = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['prodID'] == $product['prodID']) {
            $cart_item['quantity'] += 1;
            $product_exists = true;
            break;
        }
    }

    if (!$product_exists) {
        $_SESSION['cart'][] = $product;
    }

    header('Location: customerCart.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] == 'increment' && isset($_GET['prodID'])) {
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['prodID'] == $_GET['prodID']) {
                $cart_item['quantity'] += 1;
                break;
            }
        }
    } elseif ($_GET['action'] == 'decrement' && isset($_GET['prodID'])) {
        foreach ($_SESSION['cart'] as $key => &$cart_item) {
            if ($cart_item['prodID'] == $_GET['prodID']) {
                $cart_item['quantity'] -= 1;
                if ($cart_item['quantity'] <= 0) {
                    unset($_SESSION['cart'][$key]);
                }
                break;
            }
        }
    } elseif ($_GET['action'] == 'delete' && isset($_GET['prodID'])) {
        foreach ($_SESSION['cart'] as $key => $cart_item) {
            if ($cart_item['prodID'] == $_GET['prodID']) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }

    // Reindex the array to prevent issues with missing indices
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style6.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        body, h1, p, table, th, td {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: rgb(172, 235, 242);
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin-top: 120px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2.5em;
            text-align: center;
            color: #333;
        }
        
    </style>
</head>
<body>
    <nav>
        <div class="nav-left">
            <img src="image/logochaps.png">
        </div>
        <div class="nav-center">
            <?php
            if (isset($_SESSION['custName'])) {
                echo "<h4>Hi, " . $_SESSION['custName'] . "</h4>";
            } else {
                echo "<p>Guest</p>";
            }
            ?>
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
        <h1>Your Cart</h1>
        <div class="cart-list">
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                echo '<table>';
                echo '<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr>';
                $total_price = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $item_total = $item['prodPrice'] * $item['quantity'];
                    $total_price += $item_total;
                    echo '<tr>';
                    echo '<td>' . $item['prodName'] . '</td>';
                    echo '<td>RM ' . $item['prodPrice'] . '</td>';
                    echo '<td>';
                    echo '<div class="quantity-buttons">';
                    echo '<form method="get" action="customerCart.php">';
                    echo '<input type="hidden" name="prodID" value="' . $item['prodID'] . '">';
                    echo '<input type="hidden" name="action" value="decrement">';
                    echo '<button type="submit" ' . ($item['quantity'] <= 1 ? 'disabled' : '') . '>-</button>';
                    echo '</form>';
                    echo $item['quantity'];
                    echo '<form method="get" action="customerCart.php">';
                    echo '<input type="hidden" name="prodID" value="' . $item['prodID'] . '">';
                    echo '<input type="hidden" name="action" value="increment">';
                    echo '<button type="submit">+</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>RM ' . $item_total . '</td>';
                    echo '<td>';
                    echo '<form method="get" action="customerCart.php">';
                    echo '<input type="hidden" name="prodID" value="' . $item['prodID'] . '">';
                    echo '<input type="hidden" name="action" value="delete">';
                    echo '<button class="delete-button" type="submit">Remove</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '<tr><td colspan="3"><strong>Total Price</strong></td><td><strong>RM ' . $total_price . '</strong></td><td></td></tr>';
                $_SESSION['amount'] = $total_price;
                echo '</table>';
                echo '<br>';
                echo '<a href="menu_catalog.php" class="button">Add More Items</a>';
                echo '<a href="checkout.php?cust_ID=' . $_SESSION['custID'] . '" class="button" onclick="return confirm(\'Are you sure you want to proceed to checkout?\');">Proceed to Checkout</a>';

            } else {
                echo '<p>Your cart is empty!</p>';
                echo '<a href="menu_catalog.php" class="button">Go to Catalog</a>';
            }
            ?>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="style6.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <nav>
        <div class="nav-left">
            <img src="image/logochaps.png">
        </div>
        <div class="nav-center">
            <?php
            session_start();
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
        <h1>Our Products</h1>
        <div class="product-list">
            <?php
            include("dbconn.php");
            if (!isset($_SESSION['custID'])) {
                echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
                exit;
            }
            $query = "SELECT prodID, prodBrand, prodName, prodPrice, prodCat, prodPic FROM product";
            $result = mysqli_query($dbconn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product">';
                    echo '<img src="' . $row['prodPic'] . '" alt="' . $row['prodName'] . '">';
                    echo '<h2>' . $row['prodName'] . '</h2>';
                    echo '<p>Brand: ' . $row['prodBrand'] . '</p>';
                    echo '<p>Category: ' . $row['prodCat'] . '</p>';
                    echo '<p>Price: RM' . $row['prodPrice'] . '</p>';
                    echo '<br>';
                    echo '<form method="post" action="customerCart.php">';
                    echo '<input type="hidden" name="prodID" value="' . $row['prodID'] . '">';
                    echo '<input type="hidden" name="prodName" value="' . $row['prodName'] . '">';
                    echo '<input type="hidden" name="prodPrice" value="' . $row['prodPrice'] . '">';
                    echo '<button type="submit" class="button">Add to cart</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products found!</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>

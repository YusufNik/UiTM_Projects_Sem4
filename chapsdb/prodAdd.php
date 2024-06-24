<?php
include("dbconn.php");
session_start();
if (!isset($_SESSION['empID'])) {
    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prod_ID = $_POST['prodID'];
    $prod_brand= $_POST['prodBrand'];
    $prod_name= $_POST['prodName'];
    $prod_price= $_POST['prodPrice'];
    $prod_cat= $_POST['prodCat'];
    $sup_ID= $_POST['supID'];

    // Check if a new picture has been uploaded
    if (!empty($_FILES['prodPic']['name'])) {
        $prod_pic_temp = $_FILES['prodPic']['name'];
        $prod_pic = "image/" . $prod_pic_temp;
        // Move uploaded file to the destination directory
        move_uploaded_file($_FILES['prodPic']['tmp_name'], $prod_pic);
    } else {
        $prod_pic = ''; // No picture uploaded
    }

    // Check if productID already exists
    $check_query = "SELECT * FROM product WHERE prodID='$prod_ID'";
    $check_result = mysqli_query($dbconn, $check_query); // Check db(current db, sql statement)

    if (!$check_result) {
        die("Error executing query: " . mysqli_error($dbconn));
    }

    if (mysqli_num_rows($check_result) > 0) { // Check each row (if detected consider already existed else proceed insert)
        echo "<script>alert('Product ID already exists! Please choose a different ID.'); window.location= 'menu_product.php'</script>";
    } else {
        // Insert new product record
        $sql = "INSERT INTO product (prodID, prodBrand, prodName, prodPrice, prodCat, prodPic, supID) 
                VALUES ('$prod_ID','$prod_brand','$prod_name','$prod_price','$prod_cat','$prod_pic', '$sup_ID')";

        $result = mysqli_query($dbconn, $sql);

        if ($result) {
            echo "<script>alert('Successfully Added!'); window.location= 'menu_product.php'</script>";
        } else {
            echo "<script>alert('Error! Please try again'); window.location= 'menu_product.php'</script>";
            echo "Error: " . mysqli_error($dbconn);
        }
    }
    mysqli_close($dbconn);
}

$supplier = "SELECT supID, supName FROM supplier";
$supplier_query = mysqli_query($dbconn, $supplier) or die("Error: " . mysqli_error($dbconn));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Add Product</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="prodAdd.php" method="post" enctype="multipart/form-data">
                <h1>ADD NEW PRODUCT</h1>
                <br>
                <input type="text" name="prodID" placeholder="Product ID" required>
                <input type="text" name="prodBrand" placeholder="Brand" required>
                <input type="text" name="prodName" placeholder="Product Name" required>
                <input type="text" name="prodPrice" placeholder="Price (unit)" required>
                <input type="text" name="prodCat" placeholder="Category" required>
                <input type="file" name="prodPic" accept="image/jpeg, image/png, image/jpg" required>
                <select name="supID" class="state" required>
                    <option value="" disabled selected>Choose Supplier</option>
                    <?php 
                    while ($supplier = mysqli_fetch_assoc($supplier_query)) {
                        echo "<option value='" . $supplier['supID'] . "'>" . $supplier['supName'] . "</option>";
                    }
                    ?>
                </select>

                <table>
                    <tr>
                        <td rowspan="2">
                            <button type="button" onclick="window.location.href='menu_product.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                        </td>
                        <td>
                            <button type="submit"><span class="material-symbols-outlined">inventory_2</span>ADD</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>

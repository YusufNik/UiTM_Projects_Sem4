<?php
include("dbconn.php");
session_start();
if (!isset($_SESSION['empID'])) {
    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
    exit;
}

$prodID = $_REQUEST['prod_ID']; // receive from the link : EditProduct.php?prod_ID=".$row["prodID"]

// create SQL statement to retrieve data from the product table
$sql = "SELECT * FROM product WHERE prodID= '$prodID'";

// execute SQL statement that assigned to the $sql variable
$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

// get the number of records from the product table
$row = mysqli_num_rows($query);

if($row == 0){
    echo "No record found";
} else { 
    // since the records exist in the table, fetch the record value of each column
    $r = mysqli_fetch_assoc($query);
    $prod_ID = $r['prodID'];
    $prod_brand = $r['prodBrand'];
    $prod_name = $r['prodName'];
    $prod_price = $r['prodPrice'];
    $prod_cat = $r['prodCat'];
    $sup_id = $r['supID'];
    $prod_pic = $r['prodPic'];
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
    <title>Update Product</title>
</head>
<body>

<div class="container" id="container">
    <div class="form-container sign-up">
        <form action="prodUpDel.php" method="post" enctype="multipart/form-data">
            <h1>UPDATE PRODUCT</h1>
            <br>
            <input type="text" name="prodID" value="<?php echo $prod_ID; ?>" readonly onclick="displayMessage()">
            <input type="text" name="prodBrand" value="<?php echo $prod_brand; ?>" placeholder="Brand">
            <input type="text" name="prodName" value="<?php echo $prod_name; ?>" placeholder="Product Name">
            <input type="text" name="prodPrice" value="<?php echo $prod_price; ?>" placeholder="Price">
            <input type="text" name="prodCat" value="<?php echo $prod_cat; ?>" placeholder="Product Category">
            <input type="file" name="prodPic" accept="image/jpeg, image/png, image/jpg">
            <select name='supID' class='state' required>
                <?php 
                while ($supplier = mysqli_fetch_assoc($supplier_query)) {
                    $selected = ($supplier['supID'] == $sup_id) ? "selected" : "";
                    echo "<option value='" . $supplier['supID'] . "' $selected>" . $supplier['supName'] . "</option>";
                }
                ?>
            </select>
            <table>
                <tr>
                    <td rowspan="2">
                        <button type="button" onclick="window.location.href='menu_product.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                    </td>
                    <td><button type="submit" name="update" value="Update" class="button"><span class="material-symbols-outlined">update</span>Update</button></td>
                    <td><button type="submit" name="delete" value="Delete" class="button"><span class="material-symbols-outlined">delete</span>Delete</button></td>  
                </tr>
            </table>
        </form>
    </div>
</div>

</body>
</html>
<script>
function displayMessage() {
    alert("This field cannot be changed.");
}
</script>

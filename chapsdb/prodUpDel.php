<?php
// include db connection file
include("dbconn.php");

// If the update button is clicked
if (isset($_POST['update'])) {
    // capture values from HTML form
    $prod_ID = $_POST['prodID'];
    $prod_brand = $_POST['prodBrand'];
    $prod_name = $_POST['prodName'];
    $prod_price = $_POST['prodPrice'];
    $prod_cat = $_POST['prodCat'];

    // Initialize the $prod_pic variable
    $prod_pic = '';

    // Check if a new picture has been uploaded
    if (!empty($_FILES['prodPic']['name'])) {
        $prod_pic_temp = $_FILES['prodPic']['name'];
        $prod_pic = "image/" . $prod_pic_temp;
        // Move uploaded file to the destination directory
        if (move_uploaded_file($_FILES['prodPic']['tmp_name'], $prod_pic)) {
            // File successfully uploaded
        } else {
            // File upload failed
            echo "<script>alert('Failed to upload new picture.'); window.location= 'menu_product.php'</script>";
            exit();
        }
    } else {
        // If no new picture is uploaded, keep the old picture
        $sqlPic = "SELECT prodPic FROM product WHERE prodID= '$prod_ID'";
        $queryPic = mysqli_query($dbconn, $sqlPic) or die("Error: " . mysqli_error($dbconn));
        $rowPic = mysqli_fetch_assoc($queryPic);
        $prod_pic = $rowPic['prodPic'];
    }

    // Apply SQL statement to verify the specified info first
    $sqlSel = "SELECT * FROM product WHERE prodID= '$prod_ID'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);
    if ($rowSel == 0) {
        echo "<script>alert('Record does not exist!'); window.location= 'menu_product.php'</script>";
    } else {
        // Execute SQL UPDATE command
        $sqlUpdate = "UPDATE product SET 
            prodBrand = '" . $prod_brand . "',
            prodName = '" . $prod_name . "', 
            prodPrice = '" . $prod_price . "',
            prodCat = '" . $prod_cat . "',
            prodPic = '" . $prod_pic . "' 
            WHERE prodID = '" . $prod_ID . "'";

        mysqli_query($dbconn, $sqlUpdate) or die("Error: " . mysqli_error($dbconn));
        // Display a message
        echo "<script>alert('Data has been updated!'); window.location= 'menu_product.php'</script>";
    }
} else {
    // If the delete button is clicked
    if (isset($_POST['delete'])) {
        // capture values from HTML form
        $prod_ID = $_POST['prodID'];
        // Execute SQL DELETE command
        $sqlDelete = "DELETE FROM product WHERE prodID = '" . $prod_ID . "'";

        mysqli_query($dbconn, $sqlDelete) or die("Error: " . mysqli_error($dbconn));
        // Display a message
        echo "<script>alert('Data has been deleted!'); window.location= 'menu_product.php'</script>";
    } else {
        echo "<script>alert('Error! Delete unsuccessful'); window.location= 'menu_product.php'</script>";
    }
}
?>

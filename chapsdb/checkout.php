<?php
include("dbconn.php"); // Include your database connection file
session_start(); // Start session if not started already

$currentDate = date('Y-m-d');

// Check if cust_ID is provided in the request
if (!isset($_REQUEST['cust_ID'])) {
    die("Customer ID not provided.");
}

// Sanitize input
$custID = mysqli_real_escape_string($dbconn, $_REQUEST['cust_ID']);

// SQL query to retrieve customer details
$sql = "SELECT * FROM customer WHERE custID = '$custID'";
$query = mysqli_query($dbconn, $sql);
if (!$query) {
    die("Error: " . mysqli_error($dbconn));
}

$row = mysqli_num_rows($query);

if ($row == 0) {
    echo "No record found";
    exit(); // Stop further execution
}

$r = mysqli_fetch_assoc($query);
$custID = $r['custID'];
$custAddress = $r['custAddress'];
$custPostcode = $r['custPostcode'];
$custState = $r['custState'];

function generatePurID($dbconn) {
    // Characters pool
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';

    do {
        // Generate 3 random letters
        $letters = '';
        for ($i = 0; $i < 3; $i++) {
            $letters .= $alphabet[rand(0, strlen($alphabet) - 1)];
        }

        // Generate 3 random numbers
        $digits = '';
        for ($i = 0; $i < 3; $i++) {
            $digits .= $numbers[rand(0, strlen($numbers) - 1)];
        }

        // Combine letters and digits
        $purID = $letters . $digits;

        // Check if the generated ID exists in the database
        $check = "SELECT * FROM purchase WHERE purID='$purID'";
        $check_result = mysqli_query($dbconn, $check);
    } while (mysqli_num_rows($check_result) > 0);

    return $purID;
}

$purID = generatePurID($dbconn);

// Insert into Purchase table
$purOrderDate = date('Y-m-d');
$purShipDate = date('Y-m-d', strtotime($purOrderDate . ' + 10 days'));
$purStatus = 'Pending'; // Initial status for new orders
$empID = 'damia'; // Example

$sql_purchase = "INSERT INTO Purchase (purID, purOrderDate, purShipDate, purStatus, custID, empID) VALUES ('$purID', '$purOrderDate', '$purShipDate', '$purStatus', '$custID', '$empID')";

if (!mysqli_query($dbconn, $sql_purchase)) {
    echo "Error: " . $sql_purchase . "<br>" . mysqli_error($dbconn);
    exit();
}

// Insert into purchase_product table
foreach ($_SESSION['cart'] as $item) {
    $prodID = mysqli_real_escape_string($dbconn, $item['prodID']);
    $qty = mysqli_real_escape_string($dbconn, $item['quantity']);
    $price = mysqli_real_escape_string($dbconn, $item['prodPrice']);

    $sql_purchase_product = "INSERT INTO purchase_product (purID, prodID, qty, price) VALUES ('$purID', '$prodID', '$qty', '$price')";

    if (!mysqli_query($dbconn, $sql_purchase_product)) {
        echo "Error: " . $sql_purchase_product . "<br>" . mysqli_error($dbconn);
        exit();
    }
}

$amount = $_SESSION['amount'];

//echo "Purchase successfully recorded.";

// Clear the cart after successful insertion
//unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Checkout</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="checkoutProcess.php" method="post">
                <h1>CHECKOUT</h1>
                <br>
                <input type="text" name="purID" value="<?php echo $purID; ?>" readonly>
                <select name="bankName" class="state" required>
                    <option value="" disabled selected>Select Bank</option>
                    <option value="RHB">RHB</option>
                    <option value="Maybank">Maybank</option>
                    <option value="CIMB">CIMB</option>
                    <option value="Hong Leong">Hong Leong</option>
                    <option value="Bank Islam">Bank Islam</option>
                    <option value="TNG E-Wallet">TNG E-Wallet</option>
                    <option value="Bank Rakyat">Bank Rakyat</option>
                    <option value="Affin Bank">Affin Bank</option>
                    <option value="Bank Muamalat">Bank Muamalat</option>
                </select>
                <input type="text" name="accNum"  placeholder="Account Number" required>
                <input type="text" name="amount" value="RM <?php echo $amount; ?>" placeholder="Amount" readonly>
                <input type="date" name="payDate" value="<?php echo $currentDate; ?>" readonly>
                <br>
                <h1>DELIVERY ADDRESS</h1>
                <br>
                <input type="text" name="custAddress" value="<?php echo $custAddress; ?>" readonly>
                <input type="text" name="custPostcode" value="<?php echo $custPostcode; ?>" readonly>
                <input type="text" name="custState" value="<?php echo $custState; ?>" readonly>
                <br>
                <table>
                    <tr>
                    <td><button type="button" onclick="backOrder();"><span class="material-symbols-outlined">arrow_back</span>BACK</button></td>
                        <td><button type="submit" onclick="return confirm('Please make sure your details are correct! This action cannot be undone.')">
                        <span class="material-symbols-outlined">shopping_bag</span> Pay
                        </button></td>
                        <!-- <td><a href="checkoutProcess.php?cust_ID=<?php echo $_SESSION['custID']; ?>" button type="button"><span class="material-symbols-outlined">shopping_bag</span>Pay</a></td> -->
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

function backOrder() {
    if (confirm('Are you sure to go back to your cart? If you want to change your delivery address, please update your profile.')) {
        window.location.href = 'customerCart.php';
    }
}
</script>
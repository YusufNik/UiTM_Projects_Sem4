<?php
include("dbconn.php");
$studID = $_REQUEST['stud_ID']; #receive from the link : subMenu.php?sub_ID=".$row["subID"]
$currentDate = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Payment Page</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="paymentProcess.php" method="post">
                <h1>BUY PREMIUM</h1>
                <br>
                <input type="text" name="studID" value="<?php echo $studID; ?>" readonly onclick="displayMessage()">
                <select name="bankName" class="select" required>
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
                <input type="text" name="bankAcc" placeholder="Bank Account" required>
                <input type="date" name="payDate" value="<?php echo $currentDate; ?>" readonly>
                <h3>Subscription Fee : RM 20.00</h3>
                <br>

                <table>
                    <tr>
                        <td><button type="button" onclick="window.location.href='homeSubject.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button></td>
                        <td><button type="submit"><span class="material-symbols-outlined">shopping_bag</span>Buy</button></td>
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

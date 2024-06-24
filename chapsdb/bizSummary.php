<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Summary</title>
    <link rel="stylesheet" href="style4.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
</head>
<body> 
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <?php
                include("dbconn.php");
                session_start();

                // Queries to get counts and total price
                $sqlC = "SELECT COUNT(custID) AS TotalC FROM customer";
                $sqlP = "SELECT COUNT(prodID) AS TotalP FROM product";
                $sqlE = "SELECT COUNT(empID) AS TotalE FROM employee";
                $sqlS = "SELECT COUNT(supID) AS TotalS FROM supplier";
                $sqlT = "SELECT COUNT(purID) AS TotalT FROM purchase"; 
                $priceA = "SELECT SUM(price) AS TotalPrice FROM purchase_product";

                // Execute queries
                $resultC = mysqli_query($dbconn, $sqlC);
                $resultP = mysqli_query($dbconn, $sqlP);
                $resultE = mysqli_query($dbconn, $sqlE);
                $resultS = mysqli_query($dbconn, $sqlS);
                $resultT = mysqli_query($dbconn, $sqlT);
                $resultPriceA = mysqli_query($dbconn, $priceA);

                if ($resultC && $resultP && $resultE && $resultS && $resultT && $resultPriceA) {
                    // Fetching the count values
                    $rowC = mysqli_fetch_assoc($resultC);
                    $totalC = $rowC['TotalC'];

                    $rowP = mysqli_fetch_assoc($resultP);
                    $totalP = $rowP['TotalP'];

                    $rowE = mysqli_fetch_assoc($resultE);
                    $totalE = $rowE['TotalE'];

                    $rowS = mysqli_fetch_assoc($resultS);
                    $totalS = $rowS['TotalS'];
                    
                    $rowT = mysqli_fetch_assoc($resultT);
                    $totalT = $rowT['TotalT'];

                    $rowPriceA = mysqli_fetch_assoc($resultPriceA);
                    $totalPriceA = $rowPriceA['TotalPrice'];

                    echo "<br>";
                    echo "<br>";
                    echo "<center><font size='5'>Welcome to Computer Hardware Management System (CHAPS)!</font></center>";
                    echo "<br>";
                    echo "<br>";
                  
                    if (isset($_SESSION['empName'])) {
                        if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
                            echo "<h4>Hi Admin, " . $_SESSION['empName'] . "</h4>";
                        } else {
                            echo "<h4>Hi Staff, " . $_SESSION['empName'] . "</h4>";
                        }
                    } else {
                        echo "<h4>Guest</h4>";
                    }

                    echo "<br>";
                    echo"<h4> Businesss Summary:</h4>";
                    echo "<br>";
                    // Display table with statistics
                    echo "<table id='sales'>";
                    echo "<tr>";
                    echo "<th>Total Customer</th>";
                    echo "<td>" . $totalC . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Total Staff</th>";
                    echo "<td>" . $totalE . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Total Product</th>";
                    echo "<td>" . $totalP . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Supplier Collaboration</th>";
                    echo "<td>" . $totalS . "</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<th>Purchase Record</th>";
                    echo "<td>" . $totalT . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Total Sales</th>";
                    echo "<td>RM " . $totalPriceA . "</td>";
                    echo "</tr>";
                    echo "</table>";
                } else {
                    echo "Error retrieving data.";
                }
                ?>
            </form>
            <table id="hide">
            <tr>
                <td><a href='menu_home.php?empID=".$row["empID"]."' class='button2'><span class='material-symbols-outlined'>arrow_back</span>BACK</a></td>
            </tr>
        </table>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Result</title>
    <link rel="stylesheet" href="style4.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
</head>
<body>
    <div class="container" id="container">
            <form>
            <?php
            include("dbconn.php");
            session_start();
            $status = $_SESSION['status'];

            // If the script hasn't redirected yet, proceed with displaying the leaderboard
            $rowrank = 1;
            $sql = "SELECT s.studName, SUM(sa.point) AS TotalPoint
                    FROM student s
                    JOIN stud_answer sa ON s.studID=sa.studID
                    JOIN question q ON sa.quesID=q.quesID
                    JOIN topic t ON q.topID=t.topID
                    JOIN subject su ON t.subID=su.subID
                    GROUP BY s.studID
                    ORDER BY TotalPoint DESC";

            $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
            $row = mysqli_num_rows($query);

            if ($row == 0) {
                echo "No record found";
            } else {
                echo "<br><br><font size='9'>Leaderboard</font>";
                echo"<br>";
                if (isset($_SESSION['adminName'])) {
                    echo "<h4>Hi Admin, " . $_SESSION['adminName'] . "</h4>";
                }
                else if (isset($_SESSION['studName'])) {
                    echo "<h4>Hi, " . $_SESSION['studName'] . "!</h4>";
                }
                else {
                    echo "<h4>Guest</h4>"; // Display a fallback if the employee name is not set
                }
                echo"<br>";
                echo "<table border=1>";
                echo "<tr>";
                echo "<th>Rank</th>";
                echo "<th>Student Name</th>";
                echo "<th>Total Point</th>";
                echo "</tr>";
                
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>".$rowrank."</td>";
                    echo "<td>".$row["studName"]."</td>";
                    echo "<td>".$row["TotalPoint"]."</td>";
                    $rowrank = $rowrank + 1;
                }

                echo "</table>";
                if ($status == "admin") {
                    echo "<a href='menu_home.php' class='button2'><span class='material-symbols-outlined'>arrow_back</span>Back</a>";
                } else {
                    echo "<a href='homeSubject.php' class='button2'><span class='material-symbols-outlined'>arrow_back</span>Back</a>";
                }
            }
        ?> 

            </form>
        </div>
    </div>
</body>
</html>

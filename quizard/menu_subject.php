<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Subject</title>
    <link rel="stylesheet" href="style5.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <nav>
        <img src="image/logo.png">
        <a href="menu_home.php"><span class='material-symbols-outlined'>home</span>Home</a>
        <a href="menu_admin.php"><span class='material-symbols-outlined'>school</span>Admin</a>
        <a href="menu_student.php"><span class='material-symbols-outlined'>person</span>Student</a>
        <a href="menu_subject.php"><span class='material-symbols-outlined'>subject</span>Subject</a>
        <a href="menu_topic.php"><span class='material-symbols-outlined'>topic</span>Topic</a>
        <a href="menu_question.php"><span class='material-symbols-outlined'>quiz</span>Question</a>
        <a href="menu_result.php"><span class='material-symbols-outlined'>sort</span>Result</a>
        <a href="logout.php"><span class='material-symbols-outlined'>logout</span>Logout</a>
    </nav>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>

                <?php
                include("dbconn.php");
                session_start();

                if (!isset($_SESSION['adminID'])) {
                    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
                    exit;
                }
                $sql = "SELECT s.subID, s.subName, s.subCreate, s.subDesc, s.subBan, a.adminID, a.adminName from subject s
                          JOIN admin a ON s.adminID = a.adminID";
                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
                $row = mysqli_num_rows($query);

                if ($row == 0) {
                    echo "No record found";
                } else {
                    echo "<br>";
                    echo "<br>";
                    echo "<font size='9'>List of Subject Information</font>";
                    echo "<br>";
                    if (isset($_SESSION['adminName'])) {
                        echo "<h4>Hi Admin, " . $_SESSION['adminName'] . "</h4>";
                    } else {
                        echo "<h4>Guest</h4>"; // Display a fallback if the employee name is not set
                    }
                    echo '<br>';

                    echo "<table id='sorting'>";
                    echo "<tr><td><a href='subAdd.php' class='button2'><span class='material-symbols-outlined'>subject</span>Add New Subject</a>";
                    echo "<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span>Print</a></td></tr>";
                    echo "</table>";

                    echo "<table border=1>";
                    echo "<tr>";
                    echo "<th>Subject ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Created Date</th>";
                    echo "<th>Subject Description</th>";
                    echo "<th>Admin in Charge</th>";
                    echo "<th>Banner Preview</th>";
                    echo "<th>Options</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $row["subID"] . "</td>";
                        echo "<td>" . $row["subName"] . "</td>";
                        echo "<td>" . $row["subCreate"] . "</td>";
                        echo "<td>" . $row["subDesc"] . "</td>";
                        echo "<td>" . $row["adminName"] . "</td>";
                        echo "<td><img src='" . $row["subBan"] . "' alt='Subject Banner' style='max-width: 100px; height: 70px;'></td>";
                        echo "<td><a href='subEdit.php?sub_ID=" . $row["subID"] . "' class='button2'><span class='material-symbols-outlined'>edit_square</span>Edit</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                ?>

            </form>
        </div>
</body>

</html>

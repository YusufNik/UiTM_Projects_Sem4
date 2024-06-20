<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="style5.css">
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
                $sql = "SELECT * FROM student";
                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
                $row = mysqli_num_rows($query);
                if ($row == 0) {
                    echo "No record found";
                } else {
                    echo "<br>";
                    echo "<br>";
                    echo "<font size='9'>List of Student Information</font>";
                    echo "<br>";
                    if (isset($_SESSION['adminName'])) {
                        echo "<h4>Hi Admin, " . $_SESSION['adminName'] . "</h4>";
                    } else {
                        echo "<h4>Guest</h4>"; // Display a fallback if the employee name is not set
                    }
                    echo "<br>";

                    echo "<table id='sorting'>";
                    echo "<tr><td><a href='studAdd.html' class='button2'><span class='material-symbols-outlined'>person_add</span>Add New Student</a>";
                    echo "<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span>Print</a></td></tr>";
                    echo "</table>";

                    echo "<table border=1>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Phone</th>";
                    echo "<th>Email</th>";
                    echo "<th>School</th>";
                    echo "<th>Membership</th>";
                    echo "<th>Options</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $row["studID"] . "</td>";
                        echo "<td>" . $row["studName"] . "</td>";
                        echo "<td>" . $row["studPhone"] . "</td>";
                        echo "<td>" . $row["studEmail"] . "</td>";
                        echo "<td>" . $row["studSchool"] . "</td>";
                        echo "<td>";
                        if ($row["isPremium"]) {
                            echo '<img src="image/membership.png" alt="membership" id="membership">';
                        } else {
                            echo '<img src="image/notM.png" alt="notM" id="notM">';
                        }
                        echo "</td>";
                        echo "<td><a href='studEdit.php?stud_ID=" . $row["studID"] . "' class='button2'><span class='material-symbols-outlined'>edit_square</span>Edit</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                ?>
            </form>
        </div>
    </div>
</body>

</html>

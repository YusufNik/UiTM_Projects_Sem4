<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Topic</title>
    <link rel="stylesheet" href="style5.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <nav>
        <img src="image/logo.png" alt="Logo">
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
            <form method="GET" action="menu_topic.php">
                <?php
                include("dbconn.php");
                session_start();

                if (!isset($_SESSION['adminID'])) {
                    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
                    exit;
                }

                $sort = isset($_GET['sort']) ? $_GET['sort'] : '';  
                $sql = "SELECT t.topID, t.topName, t.topCreate, t.topDesc, t.subID, s.subName FROM topic t
                        JOIN subject s ON t.subID = s.subID";

                if ($sort != '' && $sort != 'all') {
                    $sql .= " WHERE t.subID = '$sort'";
                }

                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));

                if (mysqli_num_rows($query) == 0) {
                    echo "<br><br>";
                    echo "No record found";
                    echo "<button type='submit' onclick='menu_topic.php'><span class='material-symbols-outlined'>arrow_back</span>Back</button></td>";
                } else {
                    echo "<br><br>";
                    echo "<font size='9'>List of Topic Information</font>";
                    echo "<br>";

                    if (isset($_SESSION['adminName'])) {
                        echo "<h4>Hi Admin, " . $_SESSION['adminName'] . "</h4>";
                    } else {
                        echo "<h4>Guest</h4>";
                    }
                    echo "<br>";

                    // Fetch subjects for the dropdown
                    // Fetch subjects for the dropdown
                    $subject_sql = "SELECT subID, subName FROM subject";
                    $subject_query = mysqli_query($dbconn, $subject_sql) or die("Error: " . mysqli_error($dbconn));

                    echo "<table id='sorting'>";
                    echo "<tr>";
                    $selected_sort = isset($_POST['sort']) ? $_POST['sort'] : ''; // Get the selected sort value from POST data

                    echo "<td colspan='2'>Filter subject according to: 
                        <form method='POST' action=''>";
                            echo "<select name='sort' class='option'>";
                                echo "<option value='' disabled >Select Subject</option>";
                                echo "<option value='all'>All Subjects</option>";

                                while ($subject = mysqli_fetch_assoc($subject_query)) {
                                    $selected = ($subject['subID'] == $sort) ? "selected" : ""; 
                                    echo "<option value='" . $subject['subID'] . "' $selected>" . $subject['subName'] . "</option>";
                                }

                    echo "</select>";
                    echo "<form method= 'POST' action=''>";
                    echo "<button type='submit' class='custom-button'>Filter</button></td>";
                    echo "</form>";
                    echo "</tr>";
                    echo"<tr><td><a href='topAdd.php' class='button2'><span class='material-symbols-outlined'>topic</span>Add New Topic</a>";
                    echo"<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span>Print</a></td></tr>";
                    echo "</table>";

                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>Topic ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Created Date</th>";
                    echo "<th>Topic Description</th>";
                   // echo "<th>Subject Name</th>";
                    echo "<th>Options</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td>" . $row["topID"] . "</td>";
                        echo "<td>" . $row["topName"] . "</td>";
                        echo "<td>" . $row["topCreate"] . "</td>";
                        echo "<td>" . $row["topDesc"] . "</td>";
                     //   echo "<td>" . $row["subName"] . "</td>";
                        echo "<td><a href='topEdit.php?top_ID=" . $row["topID"] . "' class='button2'><span class='material-symbols-outlined'>edit_square</span>Edit</a></td>";
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

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Result</title>
    <link rel="stylesheet" href="style5.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
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

                $sort = isset($_GET['sort']) ? $_GET['sort'] : '';  //sort call method
                $sql="SELECT s.studID, s.studName, su.subName, t.topID, t.topName, SUM(sa.point) AS TotalPoint, sa.dateAns, sa.studID, COUNT(q.quesID) AS TotalQ
                        FROM student s
                        JOIN stud_answer sa ON s.studID=sa.studID
                        JOIN question q ON sa.quesID=q.quesID
                        JOIN topic t ON q.topID=t.topID
                        JOIN subject su ON t.subID=su.subID";

                if ($sort != '' && $sort != 'all') {
                    $sql .= " WHERE sa.studID = '$sort'";
                }

                $sql .= " GROUP BY su.subID, t.topID, s.studID
                        ORDER BY s.studID ASC";

                $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
                
                if (mysqli_num_rows($query) == 0) {
                    echo "<br><br>";
                    echo "No record found";
                    echo "<button type='submit'><span class='material-symbols-outlined'>arrow_back</span>Back</button></td>";
                }
                else{
                    echo"<br>";
                    echo"<br>";
                    echo"<font size='9'>List of Result Information</font>";
                    echo"<br>";

                    if (isset($_SESSION['adminName'])) {
                        echo "<h4>Hi Admin, " . $_SESSION['adminName'] . "</h4>";
                    } else {
                        echo "<h4>Guest</h4>"; // Display a fallback if the employee name is not set
                    }
                    echo"<br>";

                    // Fetch students for the dropdown
                    $student_sql = "SELECT studID, studName FROM student";
                    $student_query = mysqli_query($dbconn, $student_sql) or die("Error: " . mysqli_error($dbconn));

                    echo "<table id='sorting'>";
                    echo "<tr>";
                    echo "<td>Filter student according to: 
                            <select name='sort' class='option'>
                                <option value='' disabled selected>Choose Student</option>
                                <option value='all'>All Student</option>";
                            
                                while ($student = mysqli_fetch_assoc($student_query)) {
                                    $selected = ($student['studID'] == $sort) ? "selected" : ""; 
                                    echo "<option value='" . $student['studID'] . "' $selected>" . $student['studName'] . "</option>";
                                }
                    echo "</select>";
                    echo "<button type='submit' class='custom-button'>Filter</button></td>";
                    echo "</tr>";
                    echo "</table>";

                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Student Name</th>";
                    echo "<th>Date Taken</th>";
                    echo "<th>Subject</th>";
                    echo "<th>Topic</th>";
                    echo "<th>Point</th>";
                    echo "<th>Options</th>";
                    echo "</tr>";
                    
                    while ($row = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>".$row["studName"]."</td>";
                        echo "<td>".$row["dateAns"]."</td>";
                        echo "<td>".$row["subName"]."</td>";
                        echo "<td>".$row["topName"]."</td>";
                        echo "<td>".$row["TotalPoint"]."/".$row["TotalQ"]."</td>";
                        echo "<td>
                                <a href='resetAnswer.php?stud_ID=".$row["studID"]."&top_ID=".$row["topID"]."' class='button2'>
                                    <span class='material-symbols-outlined'>delete_forever</span>Reset
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span>Print</a></td>";
                }	
                ?>
            </form>
        </div>
    </div>
</body>
</html>

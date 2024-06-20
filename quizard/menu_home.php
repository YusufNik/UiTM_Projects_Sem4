<!DOCTYPE html>
    <html>

    <head>
        <meta vharset = "UTF-8">
        <title>Admin</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel = "stylesheet" href = "style5.css">
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
        </link>
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
                    $sqlC="SELECT COUNT(studID) AS TotalC FROM student";
                    $sqlA="SELECT COUNT(adminID) AS TotalA FROM admin";
                    $sqlS="SELECT COUNT(subID) AS TotalS FROM subject";
                    $sqlT="SELECT COUNT(topID) AS TotalT FROM topic";
                    $sqlQ="SELECT COUNT(quesID) AS TotalQ FROM question"; 

                // Execute the queries and fetch the results
                    $resultC = mysqli_query($dbconn, $sqlC);
                    $resultA = mysqli_query($dbconn, $sqlA);
                    $resultS = mysqli_query($dbconn, $sqlS);
                    $resultT = mysqli_query($dbconn, $sqlT);
                    $resultQ = mysqli_query($dbconn, $sqlQ);

                    if ($resultC && $resultA && $resultS && $resultT && $resultQ) {
                        // Fetching the count values
                        $rowC = mysqli_fetch_assoc($resultC);
                        $totalC = $rowC['TotalC'];

                        $rowA = mysqli_fetch_assoc($resultA);
                        $totalA = $rowA['TotalA'];

                        $rowS = mysqli_fetch_assoc($resultS);
                        $totalS = $rowS['TotalS'];

                        $rowT = mysqli_fetch_assoc($resultT);
                        $totalT = $rowT['TotalT'];
                        
                        $rowQ = mysqli_fetch_assoc($resultQ);
                        $totalQ = $rowQ['TotalQ'];

                        echo "<br>";
                        echo "<br>";
                        echo "<center><font size='6'>Welcome to Quizard Online Quiz!</font></center>";
                        echo "<br>";
                        echo "<br>";

                        // Check if the employee is logged in and the session variable is set
                        if (isset($_SESSION['adminName'])) {
                            echo "<h4>Hi Admin, " . $_SESSION['adminName'] . "</h4>";
                        } else {
                            echo "<h4>Guest</h4>"; // Display a fallback if the employee name is not set
                        }
                        echo "<br>";
                        echo "<br>";
                        echo "<table id='sales'>";
                        echo "<tr>";
                        echo "<th>Total Student</th>";
                        echo "<td>" . $totalC . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Total Admin</th>";
                        echo "<td>" . $totalA . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Total Subject</th>";
                        echo "<td>" . $totalS . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Total Topic</th>";
                        echo "<td>" . $totalT . "</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<th>Total Question</th>";
                        echo "<td>" . $totalQ . "</td>";
                        echo "</tr>";

                        echo "</table>";
                    } else {
                        echo "Error retrieving data.";
                    }
                    echo"<td><a href='leaderboard.php' class='button2'><span class='material-symbols-outlined'>leaderboard</span>See Leaderboard</a></td>";
                    ?>                  
                </div>
                </form>
            </div>
   

    </body>
    </html>
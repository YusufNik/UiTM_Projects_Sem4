<!DOCTYPE html>
    <html>

    <head>
        <meta charset = "UTF-8">
        <title>Question</title>
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

                    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';  //sort call method
                    $sql="select q.quesID, q.quesAsk, q.ansA, q.ansB, q.ansC, q.ansD, q.ansCorrect, q.topID, t.topName from question q
                          JOIN topic t ON q.topID=t.topID";

                    if ($sort != '' && $sort != 'all') {
                         $sql .= " WHERE  q.topID = '$sort'";
                    }

                    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

                    if (mysqli_num_rows($query) == 0) {
                        echo "<br><br>";
                        echo "No record found";
                        echo "<button type='submit'><span class='material-symbols-outlined'>arrow_back</span>Back</button></td>";
                    }
                    else{
                        echo"<br>";
                        echo"<br>";
                        echo"<font size='9'>List of Question Information</font>";
                        echo"<br>";

                        if (isset($_SESSION['adminName'])) {
                            echo "<h4>Hi Admin, " . $_SESSION['adminName'] . "</h4>";
                        } else {
                            echo "<h4>Guest</h4>"; // Display a fallback if the employee name is not set
                        }
                        echo"<br>";

                        // Fetch subjects for the dropdown
                        $topic_sql = "SELECT topID, topName FROM topic";
                        $topic_query = mysqli_query($dbconn, $topic_sql) or die("Error: " . mysqli_error($dbconn));

                        echo "<table id='sorting'>";
                        echo "<tr>";
                        echo "<td colspan='2'>Filter topic according to: 
                                <select name='sort' class='option'>
                                    <option value='' disabled selected>Choose Topic</option>
                                    <option value='all'>All Topic</option>";
                                    while ($topic = mysqli_fetch_assoc($topic_query)) {
                                        $selected = ($topic['topID'] == $sort) ? "selected" : ""; // Check if the current topic ID matches the selected ID
                                        echo "<option value='" . $topic['topID'] . "' $selected>" . $topic['topName'] . "</option>";
                                    }
                        echo "</select>";
                        echo"<button type='submit' class='custom-button'>Filter</button>";
                        echo "</tr>";
                        echo"<tr><td><a href='quesAdd.php' class='button2'><span class='material-symbols-outlined'>quiz</span>Add New Question</a></td></td></td>";
                        echo"<td><a href='#' onclick='window.print()' class='button2'><span class='material-symbols-outlined'>print</span>Print</a></td></tr>";
                        echo "</table>";

		                echo"<table border=1>";
                        echo"<tr>";
                        echo"<th>ID</th>";
                        echo"<th>Question</th>";
                        echo"<th>Answer A</th>";
                        echo"<th>Answer B</th>";
                        echo"<th>Answer C</th>";
                        echo"<th>Answer D</th>";
                        echo"<th>Correct Answer</th>";
                        //echo"<th>Topic Name</th>";
                        echo"<th>Options</th>";
                        echo"</tr>";
                        
                        while($row = mysqli_fetch_assoc($query)) {
                        echo"<tr>";
                        echo"<td>".$row["quesID"]."</td>";
                        echo"<td>".$row["quesAsk"]."</td>";
                        echo"<td>".$row["ansA"]."</td>";
                        echo"<td>".$row["ansB"]."</td>";
                        echo"<td>".$row["ansC"]."</td>";
                        echo"<td>".$row["ansD"]."</td>";
                        echo"<td>".$row["ansCorrect"]."</td>";
                        //echo"<td>".$row["topName"]."</td>";
                        echo"<td><a href='quesEdit.php?ques_ID=".$row["quesID"]."' class='button2'><span class='material-symbols-outlined'>edit_square</span>Edit</a></td>";
                        echo"</tr>";
                        }
                        echo"</table>";
                      
                    }	
                    ?>
    
                </form>
            </div>
   

    </body>
    </html>
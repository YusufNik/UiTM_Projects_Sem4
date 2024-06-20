<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Question</title>
    <link rel="stylesheet" href="quizShowStyle.css">
</head>
<body>
    
    <div class="container">
        <div class="topic-list">

        <?php
            session_start();
            $studID = $_SESSION['studID'];
            if (!isset($_SESSION['studID'])) {
                echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
                exit;
            }
            include("dbconn.php");
            $topID = mysqli_real_escape_string($dbconn, $_REQUEST['top_ID']); //secure from SQL injection $topID = $_REQUEST['top_ID'];

            // Fetch the topic name
            $topNameQ = mysqli_query($dbconn, "SELECT topName FROM topic WHERE topID='$topID'") or die ("Error: " . mysqli_error($dbconn));
            $topName = mysqli_fetch_assoc($topNameQ);

            echo '<center><h1>' . $topName['topName'] . ' Answers </h1></center>';

            // Fetch the student answers
            $studAnswerSql = 
            "SELECT qa.studAnswer
            FROM stud_answer qa
            JOIN question q ON qa.quizID = q.quizID
            WHERE q.topID = '$topID' AND qa.studID = '$studID'";

            $studAnswerQ = mysqli_query($dbconn, $studAnswerSql) or die("Error: " . mysqli_error($dbconn));
            $studAnswerRow = mysqli_num_rows($studAnswerQ);

            // Fetch the quiz questions and answers
            $sql = "SELECT quesID, quesAsk, ansA, ansB, ansC, ansD, ansCorrect FROM quiz WHERE topID='$topID'";
            $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
            $row = mysqli_num_rows($query);

            if ($row > 0) {
                echo '<form action="quizProcess.php" method="post">';
                $counter = 1;
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '<div class="card">';
                    echo '<div class="question">' . $counter . '. ' . htmlspecialchars($row['quesAsk']) . '</div>';
                    echo '<div class="answer">';

                    echo '<p>Your answer: ' . htmlspecialchars($studAnswerRow['studAnswer']) . '</p>';
                    echo 'Correct answer: '.  htmlspecialchars($row['ansCorrect']);
                    echo '<label class="ansOption"> A. ' . htmlspecialchars($row['ansA']) . '</label>';
                    echo '<label class="ansOption"> B. ' . htmlspecialchars($row['ansB']) . '</label>';
                    echo '<label class="ansOption"> C. ' . htmlspecialchars($row['ansC']) . '</label>';
                    echo '<label class="ansOption"> D. ' . htmlspecialchars($row['ansD']) . '</label>';
                    echo '<input type="hidden" name="quizID' . $counter . '" value="' . htmlspecialchars($row['quesID']) . '">';
                    echo '</div>';
                    echo '</div>';
                    $counter++;
                }
                echo '<input type="hidden" name="topID" value="' . htmlspecialchars($topID) . '">';
                echo '<centre><button type="submit" name="submit">Submit</button></centre>';
                echo '</form>';
            } else {
                echo '<p>No questions found for this topic!</p>';
            }

            mysqli_close($dbconn);
        ?>
        </div>
    </div>
</body>
</html>
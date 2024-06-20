<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Question</title>
    <link rel="stylesheet" href="quizStyleShow.css">
</head>
<body>
    
    <div class="container">
        <div class="topic-list">

        <?php
            include("dbconn.php");

            $topID = mysqli_real_escape_string($dbconn, $_REQUEST['top_ID']); //secure from SQL injection $topID = $_REQUEST['top_ID'];

            // Fetch the topic name
            $topNameQ = mysqli_query($dbconn, "SELECT topName FROM topic WHERE topID='$topID'") or die ("Error: " . mysqli_error($dbconn));
            $topName = mysqli_fetch_assoc($topNameQ);

            echo '<center><h1>' . $topName['topName'] . '</h1></center>';

            // Fetch the quiz questions and answers
            $sql = "SELECT quesID, quesAsk, ansA, ansB, ansC, ansD FROM question WHERE topID='$topID'";
            $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
            $row = mysqli_num_rows($query);

            if ($row > 0) {
                echo '<form action="quizProcess.php" method="post">';
                $counter = 1;
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '<div class="card">';
                    echo '<div class="question">' . $counter . '. ' . htmlspecialchars($row['quesAsk']) . '</div>';
                    echo '<div class="answer">';

                    echo '<label class="ansOption"><input type="radio" name="question' . $counter . '" value="A" required> A. ' . htmlspecialchars($row['ansA']) . '</label>';
                    echo '<label class="ansOption"><input type="radio" name="question' . $counter . '" value="B" required> B. ' . htmlspecialchars($row['ansB']) . '</label>';
                    echo '<label class="ansOption"><input type="radio" name="question' . $counter . '" value="C" required> C. ' . htmlspecialchars($row['ansC']) . '</label>';
                    echo '<label class="ansOption"><input type="radio" name="question' . $counter . '" value="D" required> D. ' . htmlspecialchars($row['ansD']) . '</label>';
                    echo '<input type="hidden" name="quesID' . $counter . '" value="' . htmlspecialchars($row['quesID']) . '">';
                    echo '</div>';
                    echo '</div>';
                    $counter++;
                }
                echo '<input type="hidden" name="topID" value="' . htmlspecialchars($topID) . '">';
                echo '<button type="button" onclick="goBack()" class="button2">Back</button>';
                echo '<button type="submit" name="submit">Submit</button>';
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
<script>
function goBack() {
  window.history.back();
}
</script>
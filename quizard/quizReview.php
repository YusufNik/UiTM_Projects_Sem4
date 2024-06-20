<?php
include("dbconn.php");
session_start();

if (!isset($_SESSION['studID']) || !isset($_GET['top_ID'])) {
    echo "<script>alert('Access denied!'); window.location= 'homeSubject.php'</script>";
    exit;
}

$studID = $_SESSION['studID'];
$topID = mysqli_real_escape_string($dbconn, $_GET['top_ID']);

// Fetch the topic name
$topNameQ = mysqli_query($dbconn, "SELECT topName FROM topic WHERE topID='$topID'") or die("Error: " . mysqli_error($dbconn));
$topName = mysqli_fetch_assoc($topNameQ);

// Fetch the student's answers and points
$sql = "SELECT q.quesAsk, q.ansA, q.ansB, q.ansC, q.ansD, q.ansCorrect, sa.studAnswer, sa.point 
        FROM question q
        JOIN stud_answer sa ON q.quesID = sa.quesID
        WHERE sa.studID='$studID' AND q.topID='$topID'";
$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));

$totalQuestions = mysqli_num_rows($query);
$totalPoints = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Review</title>
    <link rel="stylesheet" href="quizStyleShow.css">
</head>
<body>
    <div class="container">
        <center><h1><?php echo htmlspecialchars($topName['topName']); ?> - Quiz Review</h1></center>
        <div class="topic-list">
            <?php
            if ($totalQuestions > 0) {
                $counter = 1;
                while ($row = mysqli_fetch_assoc($query)) {
                    $totalPoints += $row['point'];
                    echo '<div class="card">';
                    echo '<div class="question">' . $counter . '. ' . htmlspecialchars($row['quesAsk']) . '</div>';
                    echo '<div class="answer">';

                    $answers = ['A' => $row['ansA'], 'B' => $row['ansB'], 'C' => $row['ansC'], 'D' => $row['ansD']];
                    foreach ($answers as $option => $text) {
                        $isCorrect = ($option == $row['ansCorrect']);
                        $isChosen = ($option == $row['studAnswer']);
                        $class = $isCorrect ? 'correct' : ($isChosen ? 'incorrect' : '');
                        echo '<label class="ansOption ' . $class . '">' . $option . '. ' . htmlspecialchars($text) . '</label>';
                    }
                    
                    echo '</div>';
                    echo '</div>';
                    $counter++;
                }

                echo '<div class="total-points" align="center">Total Points: ' . $totalPoints . '/' . $totalQuestions . '</div>';
                echo '<button type="button" onclick="goBack()" class="button2">Back</button>';
            } else {
                echo '<p>No answers found for this topic!</p>';
                echo '<button type="button" onclick="goBack()" class="button2">Back</button>';
            }
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
<?php
mysqli_close($dbconn);
?>

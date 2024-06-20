<?php
include("dbconn.php");
session_start();

if (isset($_POST['submit'])) {
    if (isset($_SESSION['studID'])) {
        $studID = $_SESSION['studID'];
        $dateAns = date("Y-m-d H:i:s");
        $topID = mysqli_real_escape_string($dbconn, $_POST['topID']);

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'question') === 0) {
                $quesNum = substr($key, 8);
                $quesID = mysqli_real_escape_string($dbconn, $_POST['quesID' . $quesNum]);
                $studentAnswer = mysqli_real_escape_string($dbconn, $value);

                // Retrieve the correct answer for this question from the database
                $correctAnswerQuery = "SELECT ansCorrect FROM question WHERE quesID='$quesID'";
                $correctAnswerResult = mysqli_query($dbconn, $correctAnswerQuery) or die ("Error: " . mysqli_error($dbconn));
                $correctAnswerRow = mysqli_fetch_assoc($correctAnswerResult);
                $correctAnswer = $correctAnswerRow['ansCorrect'];

                $point = ($studentAnswer == $correctAnswer) ? 1 : 0;

                $insertQuery = "INSERT INTO stud_answer (studID, quesID, dateAns, studAnswer, point) VALUES ('$studID', '$quesID', '$dateAns', '$studentAnswer', '$point')";
                $result = mysqli_query($dbconn, $insertQuery);

                if (!$result) {
                    echo "<script>alert('Error! Unsuccessfully Added'); window.location= 'homeSubject.php'</script>";
                    echo "Error: " . mysqli_error($dbconn);
                    exit;
                }
            }
        }

        echo "<script>alert('Quiz submitted successfully!'); window.location= 'homeSubject.php'</script>";
    } else {
        echo "<script>alert('Student ID not set!'); window.location= 'homeSubject.php'</script>";
    }
} else {
    echo "<script>alert('No quiz submitted!'); window.location= 'homeSubject.php'</script>";
}

mysqli_close($dbconn);
?>
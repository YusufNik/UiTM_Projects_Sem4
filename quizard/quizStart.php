<?php
include('dbconn.php');

session_start();
$studID = $_SESSION['studID'];

$topID = mysqli_real_escape_string($dbconn, $_REQUEST['top_ID']);

// Check if the student has already answered this quiz
$answeredSql = "SELECT * FROM stud_answer WHERE studID='$studID' AND quesID IN (SELECT quesID FROM question WHERE topID='$topID')";
$answeredResult = mysqli_query($dbconn, $answeredSql);
$answered = mysqli_num_rows($answeredResult) > 0;

// Get today's date in the format 'YYYY-MM-DD'
$todayDate = date('Y-m-d');
$todayAnswered = false;

// Check if the student already answered a quiz today
$dateSql = "SELECT dateAns FROM stud_answer WHERE studID='$studID'";
$dateResult = mysqli_query($dbconn, $dateSql) or die("Error: " . mysqli_error($dbconn));

if (mysqli_num_rows($dateResult) > 0) {
    while ($dateRow = mysqli_fetch_assoc($dateResult)) {
        if ($dateRow['dateAns'] == $todayDate) {
            $todayAnswered = true;
            break; // No need to continue once we find a match
        }
    }
}

// Check if the student account is premium
$premiumSql = "SELECT isPremium FROM student WHERE studID='$studID'";
$premiumResult = mysqli_query($dbconn, $premiumSql) or die("Error: " . mysqli_error($dbconn));
$premiumRow = mysqli_fetch_assoc($premiumResult);
$premium = $premiumRow['isPremium'];

// Determine the action based on the above checks
if ($answered) {
    // Redirect if already answered, show result
    header("Location: quizReview.php?top_ID=" . $topID);
    exit();
} else {
    if (!$todayAnswered || $premium) {
        header("Location: quizShow.php?top_ID=$topID");
    } else {
        echo "<script>alert('You already answered a quiz today! Get the premium account to answer more than one quiz every day!'); window.location= 'homeSubject.php'</script>";
    }
}
?>
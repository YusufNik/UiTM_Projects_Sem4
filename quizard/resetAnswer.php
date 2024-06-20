<?php
include("dbconn.php");

if (isset($_GET['stud_ID']) && isset($_GET['top_ID'])) {
    $studID = mysqli_real_escape_string($dbconn, $_GET['stud_ID']);
    $topID = mysqli_real_escape_string($dbconn, $_GET['top_ID']);

    // Delete the student's answers for the specific topic
    $deleteQuery = "DELETE sa FROM stud_answer sa 
                    JOIN question q ON sa.quesID = q.quesID 
                    WHERE sa.studID='$studID' AND q.topID='$topID'";
    
    if (mysqli_query($dbconn, $deleteQuery)) {
        echo "<script>alert('Student\'s answers for the topic have been reset successfully!'); window.location= 'menu_result.php'</script>";
    } else {
        echo "<script>alert('Error resetting answers: " . mysqli_error($dbconn) . "'); window.location= 'menu_result.php'</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location= 'menu_result.php'</script>";
}

mysqli_close($dbconn);
?>

<?php
// include db connection file
include("dbconn.php");

// If the update button is clicked
if (isset($_POST['update'])) {
    // capture values from HTML form
    $ques_ID = $_POST['quesID'];
    $ques_ask = $_POST['quesAsk'];
    $ans_a = $_POST['ansA'];
    $ans_b = $_POST['ansB'];
    $ans_c = $_POST['ansC'];
    $ans_d = $_POST['ansD'];
    $ans_correct = $_POST['ansCorrect'];
    $top_id = $_POST['topID'];

    // apply sql statement to verify the specified info first
    $sqlSel = "SELECT * FROM question WHERE quesID= '$ques_ID'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);
    if ($rowSel == 0) {
        echo "<script>alert('Record does not exist!'); window.location= 'menu_question.php'</script>";
    } else {
        // execute SQL UPDATE command
        $sqlUpdate = "UPDATE question SET quesAsk = '$ques_ask',
        ansA = '$ans_a', ansB = '$ans_b', ansC = '$ans_c', ansD = '$ans_d', ansCorrect = '$ans_correct', topID = '$top_id' WHERE quesID = '$ques_ID'";

        mysqli_query($dbconn, $sqlUpdate) or die("Error: " . mysqli_error($dbconn));
        // display a message
        echo "<script>alert('Data has been updated!'); window.location= 'menu_question.php'</script>";
    }
} else {
    // If the delete button is clicked
    if (isset($_POST['delete'])) {
        // capture values from HTML form
        $ques_ID = $_POST['quesID'];
        // execute SQL DELETE command
        $sqlDelete = "DELETE FROM question WHERE quesID = '$ques_ID'";

        mysqli_query($dbconn, $sqlDelete) or die("Error: " . mysqli_error($dbconn));
        // display a message
        echo "<script>alert('Data has been deleted!'); window.location= 'menu_question.php'</script>";
    } else {
        echo "<script>alert('Error! Delete unsuccessful'); window.location= 'menu_question.php'</script>";
    }
}

?>
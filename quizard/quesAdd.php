<?php
    include("dbconn.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ques_ID= $_POST['quesID'];
	$ques_ask= $_POST['quesAsk'];
	$ansA= $_POST['ansA'];
	$ansB= $_POST['ansB'];
	$ansC= $_POST['ansC'];
	$ansD= $_POST['ansD'];
	$ans_correct= $_POST['ansCorrect'];
	$topID= $_POST['topID'];

    // Check if adminID already exists
    $check_query = "SELECT * FROM question WHERE quesID='$ques_ID'";
    $check_result = mysqli_query($dbconn, $check_query); //check db(current db, sql statement)

    if (mysqli_num_rows($check_result) > 0) {  //check each row (if detected consider alr existed else proceed insert)
        echo "<script>alert('Question ID already exists! Please choose a different ID.'); window.location= 'menu_question.php'</script>";
    } else {
        $sql = "INSERT INTO question VALUES('$ques_ID', '$ques_ask','$ansA','$ansB','$ansC','$ansD','$ans_correct','$topID')";
    }

    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        echo "<script>alert('Successfully Added!'); window.location= 'menu_question.php'</script>";
    } else {
        echo "<script>alert('Error! Please try again'); window.location= 'menu_question.php'</script>";
        echo "Error: " . mysqli_error($dbconn);
    }
    mysqli_close($dbconn);
}
$topic = "SELECT topID, topName FROM topic";
$topic_query = mysqli_query($dbconn, $topic) or die("Error: " . mysqli_error($dbconn));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Add Question</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="quesAdd.php" method="post"> 
                <h1>ADD NEW QUESTION</h1>
                <br>
                <input type="text" name="quesID" placeholder="Quiz ID" required>
                <input type="text" name="quesAsk" placeholder="Question" required>
                <input type="text" name="ansA" placeholder="Answer A" required>
                <input type="text" name="ansB" placeholder="Answer B" required>
                <input type="text" name="ansC" placeholder="Answer C" required>
				<input type="text" name="ansD" placeholder="Answer D" required>
				<input type="text" name="ansCorrect" placeholder="Answer Correct [A/B/C/D]" required>
                <select name='topID' class='option' required>
				    <option value='' disabled selected>Choose Topic</option>
                <?php 
                    while ($topic = mysqli_fetch_assoc($topic_query)) {
                        echo "<option value='" . $topic['topID'] . "'>" . $topic['topName'] . "</option>";
                    }
                    ?>
                </select>
                <table>
                    <td rowspan="2">
                        <button type="button" onclick="window.location.href='menu_question.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                    </td>
                    <td>
                        <button type="submit"><span class="material-symbols-outlined">quiz</span>ADD</button>
                    </td>
                </table>
            </form>
         </div>
        
        </div>
    </div>

</body>
</html>

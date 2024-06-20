<?php
include("dbconn.php");

$quesID = $_REQUEST['ques_ID']; // Receive from the link : menu_question.php?ques_ID=".$row["quesID"]

// Create SQL statement to retrieve data from the product table
$sql= "SELECT * FROM question WHERE quesID= '$quesID'";

// Execute SQL statement that assigned to the $sql variable
$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

// Get the number of records from the product table
$row = mysqli_num_rows($query);

if($row == 0){
    echo "No record found";
}
else{ 
    // Fetch the record value of each column
    $r = mysqli_fetch_assoc($query);
    $ques_ID= $r['quesID'];
    $ques_ask= $r['quesAsk'];
    $ans_a= $r['ansA'];
    $ans_b= $r['ansB'];
    $ans_c= $r['ansC'];
    $ans_d= $r['ansD'];
    $top_created= $r['topID'];
    $ans_correct= $r['ansCorrect'];
    $top_id = $r["topID"];
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
    <title>Edit Question</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="quesUpDel.php" method="post">
                <h1>EDIT QUESTION</h1>
                <br>
                <input type="text" name="quesID" value="<?php echo $ques_ID; ?>"readonly onclick="displayMessage()">
                <input type="text" name="quesAsk" value="<?php echo $ques_ask; ?>"placeholder="Question" required>
                <input type="text" name="ansA" value="<?php echo $ans_a; ?>"placeholder="Answer A" required>
                <input type="text" name="ansB" value="<?php echo $ans_b; ?>"placeholder="Answer B" required>
                <input type="text" name="ansC" value="<?php echo $ans_c; ?>"placeholder="Answer C" required>
                <input type="text" name="ansD" value="<?php echo $ans_d; ?>"placeholder="Answer D" required>
                <input type="text" name="ansCorrect" value="<?php echo $ans_correct; ?>"placeholder="Answer Correct [A/B/C/D]" required>
                <select name='topID' class='option' required>
                <?php 
                while ($topic = mysqli_fetch_assoc($topic_query)) {
                    $selected = ($topic['topID'] == $top_id) ? "selected" : "";
                    echo "<option value='" . $topic['topID'] . "' $selected>" . $topic['topName'] . "</option>";
                }
                ?>
            </select>

                <table>
                    <tr>
                        <td rowspan="2">
                            <button type="button" onclick="window.location.href='menu_question.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button></td>
                            <td><button type="submit" name="update" value="Update"><span class="material-symbols-outlined">update</span>Update</button></td>
						    <td><button type="submit" name="delete" value="Delete"><span class="material-symbols-outlined">delete</span>Delete</button></td>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
<script>
function displayMessage() {
    alert("This field cannot be changed.");
}
</script>
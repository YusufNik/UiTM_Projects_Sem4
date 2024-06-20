<?php
    include("dbconn.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $top_id = $_POST['topID'];
	$top_name= $_POST['topName'];
	$top_create= $_POST['topCreate'];
    $top_desc = $_POST['topDesc'];
	$sub_id= $_POST['subID'];

    // Check if adminID already exists
    $check_query = "SELECT * FROM topic WHERE topID='$top_id'";
    $check_result = mysqli_query($dbconn, $check_query); //check db(current db, sql statement)

    if (mysqli_num_rows($check_result) > 0) {  //check each row (if detected consider alr existed else proceed insert)
        echo "<script>alert('Topic ID already exists! Please choose a different ID.'); window.location= 'menu_topic.php'</script>";
    } else {
        $sql = "INSERT INTO topic (topID, topName, topCreate, topDesc, subID) VALUES('$top_id', '$top_name', '$top_create', '$top_desc', '$sub_id')";
    }

    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        echo "<script>alert('Successfully Added!'); window.location= 'menu_topic.php'</script>";
    } else {
        echo "<script>alert('Error! Please try again'); window.location= 'menu_topic.php'</script>";
        echo "Error: " . mysqli_error($dbconn);
    }
    mysqli_close($dbconn);
    }

    $subject = "SELECT subID, subName FROM subject";
    $subject_query = mysqli_query($dbconn, $subject) or die("Error: " . mysqli_error($dbconn));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Add Topic</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">

            <form action="topAdd.php" method="post">
                <h1>ADD NEW TOPIC</h1>
                <br>
                <input type="text" name="topID" placeholder="Topic ID" required>
                <input type="text" name="topName" placeholder="Topic Name" required>
                <input type="date" name="topCreate" placeholder="Topic Create" required>
                <input type="text" name="topDesc" placeholder="Topic Description" required>
                <select name='subID' class='option' required>
                    <option value='' disabled selected>Choose Subject</option>
                    <?php 
                    while ($subject = mysqli_fetch_assoc($subject_query)) {
                        echo "<option value='" . $subject['subID'] . "'>" . $subject['subName'] . "</option>";
                    }
                    ?>
                </select>
                
                <table>
                    <tr>
                        <td rowspan="2">
                            <button type="button" onclick="window.location.href='menu_topic.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                        </td>
                        <td>
                            <button type="submit"><span class="material-symbols-outlined">topic</span>ADD</button>
                        </td>
                    </tr>
                </table>
            </form>
         </div>
        
    </div>

</body>

</html>

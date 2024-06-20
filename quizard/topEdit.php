<?php
include("dbconn.php");

$topID = $_REQUEST['top_ID']; #receive from the link : topMenu.php?top_ID=".$row["topID"]

#create SQL statement to retrieve data from the topic table
$sql= "SELECT * FROM topic WHERE topID= '$topID'";

#execute SQL statement that assigned to the $sql variable
$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

#get the number of records from the topic table
$row = mysqli_num_rows($query);

if($row == 0){
    echo "No record found";
} else { 
    #fetch the record value of each column
    $r = mysqli_fetch_assoc($query);
    $top_id = $r['topID'];
    $top_name = $r['topName'];
    $top_create = $r['topCreate'];
    $top_desc = $r['topDesc'];
    $sub_id = $r['subID'];
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
    <title>Edit Topic</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="topUpDel.php" method="post">
                <h1>EDIT TOPIC</h1>
                <br>
                <input type="text" name="topID" value="<?php echo $top_id; ?>"readonly onclick="displayMessage()">
                <input type="text" name="topName" value="<?php echo $top_name; ?>"placeholder="Topic Name" required>
                <input type="date" name="topCreate" value="<?php echo $top_create; ?>"placeholder="Date Create" required>
                <input type="text" name="topDesc" value="<?php echo $top_desc; ?>"placeholder="Topic Description" required>
                <select name='subID' class='option' required>
                <?php 
                while ($subject = mysqli_fetch_assoc($subject_query)) {
                    $selected = ($subject['subID'] == $sub_id) ? "selected" : "";
                    echo "<option value='" . $subject['subID'] . "' $selected>" . $subject['subName'] . "</option>";
                }
                ?>
            </select>

                <table>
                    <tr>
                        <td rowspan="2">
                            <button type="button" onclick="window.location.href='menu_topic.php';"><span class="material-symbols-outlined">arrow_back</span>BACK</button>
                        </td>
                        <td><button type="submit" name="update" value="Update"><span class="material-symbols-outlined">update</span>Update</button></td>
						<td><button type="submit" name="delete" value="Delete"><span class="material-symbols-outlined">delete</span>Delete</button></td>
                    </tr>
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
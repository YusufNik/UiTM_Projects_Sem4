<?php
// include db connection file
include("dbconn.php");

// If the update button is clicked
if(isset($_POST['update'])){
    // capture values from HTML form
    $top_id = $_POST['topID'];
    $top_name = $_POST['topName'];
    $top_create = $_POST['topCreate'];
    $top_desc = $_POST['topDesc'];
    $sub_id = $_POST['subID'];

    // verify the specified info first
    $sqlSel = "SELECT * FROM topic WHERE topID= '$top_id'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);
    if($rowSel == 0){
        echo "<script>alert('Record does not exist!'); window.location= 'menu_topic.php'</script>";
    } else {
        // execute SQL UPDATE command
        $sqlUpdate = "UPDATE topic SET 
            topName = '$top_name', 
            topCreate = '$top_create', 
            topDesc = '$top_desc', 
            subID = '$sub_id' 
            WHERE topID = '$top_id'";

        if(mysqli_query($dbconn, $sqlUpdate)) {
            echo "<script>alert('Data has been updated!'); window.location= 'menu_topic.php'</script>";
        } else {
            echo "Error updating record: " . mysqli_error($dbconn);
        }
    }
} else if(isset($_POST['delete'])) {
    // If the delete button is clicked
    $top_id = $_POST['topID'];
    // execute SQL DELETE command
    $sqlDelete = "DELETE FROM topic WHERE topID = '$top_id'";

    if(mysqli_query($dbconn, $sqlDelete)) {
        echo "<script>alert('Data has been deleted!'); window.location= 'menu_topic.php'</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($dbconn);
    }
} else {
    echo "<script>alert('Error! No action taken.'); window.location= 'menu_topic.php'</script>";
}
?>
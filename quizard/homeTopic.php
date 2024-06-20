<?php
session_start(); // Start the session at the very beginning of the script
include("dbconn.php");

// Check if the student is logged in and the session variable is set
if (!isset($_SESSION['studID'])) {
    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
    exit;
}

// Get the student ID from the session
$studID = $_SESSION['studID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Topic</title>
    <link rel="stylesheet" href="homeTStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
</head>
<body>
    <nav>
        <div class="nav-left">
        <?php 
            $check = "SELECT isPremium FROM student WHERE studID = '$studID' AND isPremium = TRUE";
            $check_result = mysqli_query($dbconn, $check);
            
            if(mysqli_num_rows($check_result) > 0) {
                echo '<img src="image/quizard+.png" alt="Premium Logo" id="premiumL">';
            } else {
                echo '<img src="image/logo.png" alt="Regular Logo">';
            }
        ?>
        </div>
        <div class="nav-center">
            <?php
            // Check if the student is logged in and the session variable is set
            if (isset($_SESSION['studName'])) {
                echo "<h4>Hi, ".$_SESSION['studName']."!</h4>";
            } else {
                echo "<p>Guest</p>"; // Display a fallback if the student name is not set
            }
            ?>
        </div>
        <div class="nav-right">
            <a href="homeSubject.php"><span class="material-symbols-outlined">home</span>Home</a>
            <?php
            if(mysqli_num_rows($check_result) < 1) {
                echo '<a href="paymentPage.php?stud_ID=' . $_SESSION['studID'] . '"><span class="material-symbols-outlined">shopping_cart</span>Buy Premium</a>';
            }
            ?>
            <a href="sUpProfile.php?stud_ID=<?php echo $_SESSION['studID']; ?>"><span class="material-symbols-outlined">update</span>Update Profile</a>
            <a href="aboutUs.php"><span class="material-symbols-outlined">help</span>About Us</a>
            <a href="logout.php"><span class="material-symbols-outlined">logout</span>Logout</a>
        </div>
        <span></span>
    </nav>
    
    <!-- A div with container id to hold the card -->
    <div class="container">
        <br><br><br>
        <h1>Choose your topic</h1>
        <div class="topic-list">
            <?php
            // SQL query to fetch topic details
            $subID = mysqli_real_escape_string($dbconn, $_GET['sub_ID']); // Use mysqli_real_escape_string to prevent SQL injection
            $query = "SELECT topID, topName, topDesc FROM topic WHERE subID='$subID'";
            $result = mysqli_query($dbconn, $query);

            // Check if there are results
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $topID = $row['topID'];
                    
                    // Check if the student has already answered this quiz
                    $answeredQuery = "SELECT * FROM stud_answer WHERE studID='$studID' AND quesID IN (SELECT quesID FROM question WHERE topID='$topID')";
                    $answeredResult = mysqli_query($dbconn, $answeredQuery);
                    $answered = mysqli_num_rows($answeredResult) > 0;

                    // Display the topic card
                    echo '<div class="card">';
                    echo '<'. $row['topID'] . '.jpg" alt="' . htmlspecialchars($row['topName']) . '">';
                    echo '<div class="card__details">';
                    echo '<div class="name">'. htmlspecialchars($row['topName']) .'</div>';
                    echo '<p>'. htmlspecialchars($row['topDesc']) .'</p>';
                    
                    if ($answered) {
                        echo "<a href='quizStart.php?top_ID=".$row["topID"]."' class='button'>Review</a>";
                    } else {
                        echo "<a href='quizStart.php?top_ID=".$row["topID"]."' class='button'>Choose</a>";
                    }
                    
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No topic found!</p>';
            }

            mysqli_close($dbconn);
            ?>

            <div class="back-button-container">
                <a href="homeSubject.php" class="button"><span class="material-symbols-outlined">arrow_back</span>Back</a>
            </div>
        </div>
    </div>
</body>
</html>

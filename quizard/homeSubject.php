<?php
session_start(); // Start the session
include("dbconn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Subject</title>
    <link rel="stylesheet" href="homeStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
</head>
<body>
    <nav>
        <div class="nav-left">
        <?php 
            $check = "SELECT isPremium FROM student WHERE studID = '" . $_SESSION['studID'] . "' AND isPremium = TRUE";
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
    </nav>

    <div class="container2">
        <h1 align="center">Choose your subject</h1>
        <div class="subject-list">
            <?php
                include("dbconn.php");
                if (!isset($_SESSION['studID'])) {
                    echo "<script>alert('You need to login first!'); window.location= 'login.html'</script>";
                    exit;
                }
                
                $status = $_SESSION['status'];
                $query = "SELECT subID, subName, subDesc, subBan FROM subject";
                $result = mysqli_query($dbconn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="card">';
                        echo '<img src="' . $row['subBan'] . '" alt="' . $row['subName'] . '" style="width:100%;">';
                        echo '<div class="card__details">';
                        echo '<div class="name">'. $row['subName'] .'</div>';
                        echo '<p>'.$row['subDesc'].'</p>';
                        echo "<a href='homeTopic.php?sub_ID=".$row["subID"]."' class='button' >Choose</a>"; 
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No subject found!</p>';
                }
            ?>
        </div>
        <br>
        <table id="but3">
            <tr>
                <td><a href='leaderboard.php?stud_ID=".$row["studID"]."' class='button'><span class='material-symbols-outlined'>leaderboard</span>See Leaderboard</a></td>
            </tr>
        </table>
    </div>
</body>
</html>

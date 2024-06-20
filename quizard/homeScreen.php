<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Screen</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(203, 237, 211);
        }
        .nav {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }
        .nav img {
            max-width: 150px;
        }
        .section {
            padding: 40px;
            justify-content: center;
            align-items: center;
        }
        .admins {
            background-color: rgb(237, 203, 225);
        }
        .feedback{
            justify-content: center;
            align-items: center;
        }
        .container2 {
            max-width: 1200px;
            margin: 0 auto;
        }
        .list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .card {
            background-color: white;
            border: 1px solid #bacdd8;
            border-radius: 12px;
            margin: 10px;
            padding: 10px;
            height: auto;
            width: 500px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card__details {
            padding: 8px 8px 2px 8px;
        }

        .name {
            font-size: 24px;
            font-weight: 600;
            margin-top: 16px;
        }
        .button {
            text-decoration: none;
            display: inline-block;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            color: #0077ff;
            background-color: #e0efff;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .button:hover,.button:focus {
            background-color: #0077ff;
            color: #e0efff;
        }
        .section.banner img{
            width: 70%;
            border-radius: 5%;
            margin-left: 190px;
        }
        .section img{
            width: 90%;
            border-radius: 5%;
        }
        p{
            height: 40px;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="nav">
        <img src="image/logo.png" alt="Logo">
    </div>

    <div class="section banner">
        <table>
            <tr>
                <td>
                    <h1>Own your studying with fun quiz and study methods</h1>
                    <h3>Join our community using Quizzard and connect with friends</h3>
                    <a href='login.html' class='button' >Join Now!</a>
                </td>
                <td><img src="image/children-school.jpg"></td>
        </table>
        
        
        
    </div>

    <div class="section admins">
        <div class="container2">
            <h1 align="center">Get To Know The Admins</h1>
            <div class="list">
                <?php 
                    include("dbconn.php");               
                    $query = "SELECT adminID, adminName, adminMajor, adminEmail, adminPic FROM admin";
                    $result = mysqli_query($dbconn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="card">';
                                echo '<table>';
                                    echo '<td><img src="' . $row['adminPic'] . '" alt="' . $row['adminName'] . '" style="width:90%;">';
                                    echo '<div class="card__details">';
                                        echo '<td>';
                                            echo '<div class="name">'. $row['adminName'] .'</div>';
                                            echo '<p>'.$row['adminMajor'].'</p>';
                                            echo '<p>'.$row['adminEmail'].'</p>';
                                        echo '</td>';
                                    echo '</div>';
                                echo '</table>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No subject found!</p>';
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="section feedback">
        <h1 align='center'>Honest feedback from our students</h1>

        <div class="list">

            <div class="card">
                <div class="card__details">
                    <h1>Nurin Adira</h1>
                        <i>"Quizzard has been a game-changer for my study routine! The quizzes are engaging, and I love the immediate feedback. It helps me understand where I need to improve."</i>
                </div>
            </div>
            <div class="card">
                <div class="card__details">
                    <h1>Muhammad Adli</h1>
                        <i>"Quizzard makes learning fun! The interactive elements and rewards system encourage me to keep coming back and improving my scores."</i>
                </div>
            </div>
            <div class="card">
                <div class="card__details">
                    <h1>Zarith Adha</h1>
                        <i>"Quizzard has a great balance of challenging and easier quizzes. It helps build my confidence as I tackle more difficult subjects."</i>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
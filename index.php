<?php
include_once 'database.php';

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user 
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Dashboard</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <h1>My Dashboard</h1>
        <div id="logo">
            <img src="logo.png" alt="App Logo" style="float: left;">
        </div>
        <div id="date-time-display"></div>

        <div id="sidebar">
            <button class="button" id="chart-btn">Chart</button>
            <button class="button" id="today-btn">Today</button>
            <button class="button" id="food-list-btn">Food List</button>
            <button class="button"><a href="https://food-guide.canada.ca/en/" style="cursor: default; color: white; text-decoration:none;">Food Guide</a></button>
            <button class="button"><a href="https://www.heartandstroke.ca/healthy-living/healthy-eating/specific-diets" style="cursor: default; color: white; text-decoration:none;">Diet Guide</a></button>
            <button class="button"><a href="https://www.canada.ca/en/public-health/services/publications/healthy-living/physical-activity-tips-adults-18-64-years.html" style="cursor: default; color: white; text-decoration:none;">Exercise Plan</a></button>
        </div>
        <div id="main-content">
            <?php if (isset($user)): ?>
                
                <p>Welcome Back! <br><?= htmlspecialchars($user["name"]) ?></p>
                <p><a href="logout.php">Log out</a></p>
            <?php else: ?>

                <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>

            <?php endif; ?>
        </div>

        <div id="footer">
        <footer>
                <p> © All rights reserved, 2023 </p>
            </footer>
        </div>
    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#food-list-btn").click(function(){
                console.log("Button clicked");
                $.ajax({
                    url: 'food_list.php',
                    type: 'GET', 
                    success: function(response){
                        $('#main-content').html(response);
                    },
                    error: function(xhr, status, error){
                        console.error("Error occurred: " + error);
                    }
                });
            });
        });

        $(document).ready(function(){
            $("#today-btn").click(function(){
                console.log("Button clicked");
                $.ajax({
                    url: 'today.php',
                    type: 'GET', 
                    success: function(response){
                        $('#main-content').html(response);
                    },
                    error: function(xhr, status, error){
                        console.error("Error occurred: " + error);
                    }
                });
            });
        });

        $(document).ready(function(){
            $("#chart-btn").click(function(){
                console.log("Button clicked");
                $.ajax({
                    url: 'chart.php',
                    type: 'GET', 
                    success: function(response){
                        $('#main-content').html(response);
                    },
                    error: function(xhr, status, error){
                        console.error("Error occurred: " + error);
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php
include "config.php";
include "login.php";

?>

<html>
<title>Quiz</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" href="css/index.css">
<style>

</style>
<body>

<div class="w3-container w3-helvetica">
    <img src="img/travel2.jpg" alt="travel" width="100%">
    <p class="w3-xlarge" style="float: left">Welcome to Geoquiz </p>
    <div class="user_cred">
        <?php echo $login_html ?>
    </div>
</div>

<div>
    <div class="w3-bar w3-light-grey">
        <a href="index.php" class="w3-bar-item w3-button">Home</a>
        <a href="training.php" class="w3-bar-item w3-button">Training with Geoquiz</a>
        <a href="getquiz.php" class="w3-bar-item w3-button">Take up quiz</a>
        </div>
    </div>
</div>

<div class="w3-container">
    <h2></h2>
</div>

<div class="w3-container w3-helvetica">
    <div class="w3-card-4" style="width:100%;">
        <header class="w3-container w3-blue">
            <h3>Home</h3>
        </header>

        <div class="w3-container w3-large">
            <div class="w3-container w3-helvetica">
                <img src="img/books.png" alt="travel" width="15%">
                <p><br>Want to expand your knowledge on geography????</br>
                    <br> You are at the right place with us</br>
                    <br>In Geoquiz you can find questions and facts about different countries and continents and stay up to date.</br></p>
            </div>

            <footer class="w3-container w3-round">
                <h2></h2>
            </footer>
        </div>
    </div>

    <div class="w3-container">
        <h2></h2>
    </div>

    <div class="w3-container w3-helvetica">
        <div class="w3-card-4" style="width:100%;">
            <header class="w3-container w3-blue">
                <h3>Why Geoquiz????</h3>
            </header>

            <div class="w3-container w3-large">
                <div class="w3-container w3-helvetica">
                    <p>
                        <br>In Geoquiz you have the opportunity to improve your knowledge in general about the world </br>
                        <br>We update our quiz regularly so that you can get to learn new facts daily</br>
                    </p>
                </div>

                <footer class="w3-container w3-round">
                    <h2></h2>
                </footer>
            </div>
        </div>
        <script src="js/helloscr.js"> </script>
        <p id="disp"></p>
</body>
</html>

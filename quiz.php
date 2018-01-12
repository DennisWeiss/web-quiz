<?php
include "config.php";
include "login.php";

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
?>

<html>
<title>Quiz</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" href="css/register.css">
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/quiz.css">
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
        <a href="index.php" class="w3-bar-item w3-button">Home</a>Training with Geoquiz
        <a href="training.php" class="w3-bar-item w3-button"></a>
        <a href="quiz.php" class="w3-bar-item w3-button">Take up quiz</a>
    </div>
</div>

<div id="quiz">

    <div class="w3-container">
        <h2></h2>
    </div>

    <div class="w3-container w3-helvetica" id="question">
        <div class="w3-card-4" style="width:100%;">
            <header class="w3-container w3-blue" id="question-header">
                <h3>Quiz</h3>
            </header>
            <div id="question-text"></div>
        </div>
    </div>

    <div class="w3-container w3-helvetica" id="answer-a">
        <div class="w3-card-4" style="width:100%;">
            <header class="w3-container w3-blue">
                <h3>A</h3>
            </header>
            <div id="answer-a-text"></div>
        </div>
    </div>

    <div class="w3-container w3-helvetica" id="answer-b">
        <div class="w3-card-4" style="width:100%;">
            <header class="w3-container w3-blue">
                <h3>B</h3>
            </header>
            <div id="answer-b-text"></div>
        </div>
    </div>

    <div class="w3-container w3-helvetica" id="answer-c">
        <div class="w3-card-4" style="width:100%;">
            <header class="w3-container w3-blue">
                <h3>C</h3>
            </header>
            <div id="answer-c-text"></div>
        </div>
    </div>

    <div class="w3-container w3-helvetica" id="answer-d">
        <div class="w3-card-4" style="width:100%;">
            <header class="w3-container w3-blue">
                <h3>D</h3>
            </header>
            <div id="answer-d-text"></div>
        </div>
    </div>

    <div id="quizbutton">

    </div>

</div>
    <p id="disp"></p>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/quiz.js"></script>

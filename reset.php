<?php

session_start();

if (isset($_GET['user']) && isset($_GET['authcode'])) {
    include "config.php";

    $content = "";

    $connection = new mysqli($db_url, $db_username, $db_password, $db_name);
    $username = $_GET['user'];

    $result = $connection->query("SELECT * FROM user WHERE username = '$username';");

    if ($result->num_rows == 0) {
        $content = "Unknown user";
    } else {
        $row = $result->fetch_row();

        if ($row[3] == $_GET['authcode']) {
            $_SESSION['user'] = $username;
            $content =
                "<form action='change-pw.php' method='post'><input type='password' name='pw1' placeholder='New password'><br>" .
                "<input type='password' name='pw2' placeholder='Retype password'><br><input type='submit' value='Submit'></form>";
        } else {
            $content = "Wrong authentication code!";
        }
    }

} else {
    header('Location: reset-pw.php');
}
?>
<html>
<title>Quiz</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" href="css/register.css">
<link rel="stylesheet" href="css/index.css">
<style>

</style>
<body>

<div class="w3-container w3-helvetica">
    <img src="img/travel2.jpg" alt="travel" width="100%">
    <p class="w3-xlarge" style="float: left">Welcome to Geoquiz </p>
    <div class="user_cred">

    </div>
</div>

<div>
    <div class="w3-bar w3-light-grey">
        <a href="index.php" class="w3-bar-item w3-button">Home</a>
        <a href="training.php" class="w3-bar-item w3-button">Training with Geoquiz</a>
        <a href="quiz.php" class="w3-bar-item w3-button">Take up quiz</a>
    </div>
</div>

<div class="w3-container">
    <h2></h2>
</div>

<div class="w3-container w3-helvetica">
    <div class="w3-card-4" style="width:100%;">
        <header class="w3-container w3-blue">
            <h3>Register</h3>
        </header>

        <div id="register">
            <form>
                <div class="field"><input type="password" id="pw1" placeholder="Password"><br></div>
                <div class="field"><input type="password" id="pw2" placeholder="Confirm Password"><br></div>
                <div class="field"><input type="button" id="submit-reset" value="Reset Password"><br></div>
            </form>
        </div>
    </div>

    <p id="disp"></p>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/reset.js"></script>

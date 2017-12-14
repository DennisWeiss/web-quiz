<?php
include "config.php";
include "sendmail.php";
include "login.php";

$message = "";

if (isset($_POST['email'])) {
    $connection = new mysqli($db_url, $db_username, $db_password, $db_name);

    $email = $_POST['email'];

    $result = $connection->query("SELECT username, auth_code FROM user WHERE email = '$email';");

    if ($result->num_rows == 0) {
        $message = "Invalid email-address!";
    } else {
        $row = $result->fetch_row();
        $username = $row[0];
        $authcode = $row[1];
        $message = reset_pw($username, $email, $authcode);
    }
}
?>


<html>
<title>Reset your password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" href="css/index.css">
<style>

</style>
<body>

<div class="w3-container w3-lobster">
    <img src="img/travel2.jpg" alt="travel" width="100%">
    <p class="w3-xlarge" style="float: left">Reset your password</p>
    <div class="user_cred">
        <?php echo $login_html ?>
    </div>
</div>

<div>
    <div class="w3-bar w3-light-grey">
        <a href="index.php" class="w3-bar-item w3-button">Home</a>
        <a href="training.php" class="w3-bar-item w3-button">Training with Geoquiz</a>
        <div class="w3-dropdown-hover">
            <button class="w3-button">Take up quiz</button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="#"  onclick="pagechange()" class="w3-bar-item w3-button">Europe</a>
                <a href="#" class="w3-bar-item w3-button">Asia</a>
            </div>
        </div>
    </div>
</div>

<div class="w3-container">
    <h2></h2>
</div>

<div class="w3-container w3-lobster">

    <div class="w3-card-4" style="width:100%;">
        <header class="w3-container w3-blue">
            <h3>Reset your password</h3>
        </header>

        <div class="w3-container">
            <form action="reset-pw.php" method="post">
                <input type="text" name="email" placeholder="Enter your e-mail address">
                <input type="submit" value="Submit">
            </form>
            <div id="message"><?php echo $message; ?></div>
        </div>
    </div>

    <script src="js/helloscr.js"> </script>
    <p id="disp"></p>
</body>
</html>

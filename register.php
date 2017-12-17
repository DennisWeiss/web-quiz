<?php

include "config.php";
include "sendmail.php";
include "login.php";


if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

if (isset($_POST['register'])) {
    $connection = new mysqli($db_url, $db_username, $db_password, $db_name);

    if ($error = $connection->connect_error) {
        die("Database connection failed: $error");
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pw1'];
    $auth_code = random_string(22);
    $password = crypt($password, "$2y$08$" . $auth_code);

    $result = $connection->query("SELECT * FROM user WHERE email = '$email';");

    if ($result->num_rows > 0) {
        $row = $result->fetch_row();
        if ($row[4] == 1) {
            echo "There is already an account registered with that email-address.";
        } else {
            echo "You already registered that email-address, but did not authenticate it<br>";
            echo "<a href='resend-authcode.php?user=$username'>Resend authentication code</a>";
        }
    } else {
        $result = $connection->query("SELECT * FROM user WHERE username = '$username'");
        if ($result->num_rows > 0) {
            echo "That username is taken already.";
        } else {
            send_email($username, $email, $password, $auth_code, $connection);
        }
    }

    $connection->close();
}

function random_string($length) {
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $random_string .= chr(mt_rand(97, 122));
    }
    return $random_string;
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

<div class="w3-container w3-helvetica">
    <div class="w3-card-4" style="width:100%;">
        <header class="w3-container w3-blue">
            <h3>Register</h3>
        </header>

        <div id="register">
            <form action="register.php" method="post">
                <div class="field"><input type="text" name="username" placeholder="Username"><br></div>
                <div class="field"><input type="email" name="email" placeholder="Your Email"><br></div>
                <div class="field"><input type="password" name="pw1" placeholder="Password"><br></div>
                <div class="field"><input type="password" name="pw2" placeholder="Confirm Password"><br></div>
                <div class="field"><input type="submit" value="Register"></div>
                <div class="field"><input type="hidden" name="register"></div>
            </form>
        </div>
    </div>

    <script src="js/helloscr.js"> </script>
    <p id="disp"></p>
</body>
</html>

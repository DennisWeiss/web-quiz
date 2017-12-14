<?php
include "config.php";

$login_html = "";

session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    $login_html .= "Hello $username, you are logged in!";
    $login_html .= "<form action='logout.php' method='post'>";
    $login_html .= "<input type='submit' value='Logout'>";
    $login_html .= "<input type='hidden' name='logout'>";
    $login_html .= "</form>";
} else {
    $msg = "";

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $connection = new mysqli($db_url, $db_username, $db_password, $db_name);
        $username = $_POST['username'];
        if ($result = $connection->query("SELECT * FROM user WHERE username = '$username';")) {
            $row = $result->fetch_row();
            if ($row[2] == md5($_POST['password'])) {
                if ($row[4] == 1) {
                    $_SESSION['user'] = $username;
                    header('Location: index.php');
                } else {
                    $msg = "User is not yet authenticated!<br>";
                }
            } else {
                $msg = "Wrong username or wrong password!<br>";
            }
        } else {
            $msg = "Oops, something went wrong<br>";
        }
    }


    $login_html .= "<form action='index.php' method='post'>";
    $login_html .= "<input type='text' name='username' placeholder='Username or Email'>";
    $login_html .= "<input type='password' name='password' placeholder='Password'>";
    $login_html .= "<input type='submit' value='Login'>";
    $login_html .= "<br>" . $msg;
    $login_html .= "</form>";
    $login_html .= "<a href='register.php' style='margin: 10px'>Register</a>";
    $login_html .= "<a href='reset-pw.php'>Forgot your password?</a>";

}
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

<div class="w3-container w3-lobster">
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

<div class="w3-container w3-lobster">
    <div class="w3-card-4" style="width:100%;">
        <header class="w3-container w3-blue">
            <h3>Home</h3>
        </header>

        <div class="w3-container w3-large">
            <div class="w3-container w3-lobster">
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

    <div class="w3-container w3-lobster">
        <div class="w3-card-4" style="width:100%;">
            <header class="w3-container w3-blue">
                <h3>Why Geoquiz????</h3>
            </header>

            <div class="w3-container w3-large">
                <div class="w3-container w3-lobster">
                    <p>
                        <br>In Geoquiz you have the oppourtunity to improve your knowledge in general about the world </br>
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

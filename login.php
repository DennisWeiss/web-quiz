<?php

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


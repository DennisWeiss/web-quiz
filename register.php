<?php

include "config.php";
include "sendmail.php";

session_start();

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
    $password = md5($password);
    $auth_code = random_string(15);

    $result = $connection->query("SELECT * FROM user WHERE email = '$email'");

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
<head>
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username"><br/>
        <input type="email" name="email" placeholder="Your Email"><br/>
        <input type="password" name="pw1" placeholder="Password"><br/>
        <input type="password" name="pw2" placeholder="Confirm Password"><br/>
        <input type="submit" value="Register">
        <input type="hidden" name="register">
    </form>
</body>
</html>

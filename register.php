<?php

include "config.php";

session_start();

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

    $connection->query("INSERT INTO user(username, email, password, auth_code, authenticated) VALUES('$username', '$email', '$password', '$auth_code', 0);");

    $connection->close();

    echo "An authentication code has been sent to your e-mail address, please confirm your e-mail!";
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

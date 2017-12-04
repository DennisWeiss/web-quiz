<?php
include "config.php";

if (!isset($_GET['user']) || !isset($_GET['authcode'])) {
    echo "Oops, something went wrong with your authentication.<br/>";
} else {
    $connection = new mysqli($db_url, $db_username, $db_password, $db_name);
    $username = $_GET['user'];
    $auth_code = $_GET['authcode'];
    $result = $connection->query("SELECT username, auth_code FROM user WHERE username = '$username' AND auth_code = '$auth_code';");
    if ($result->num_rows == 1) {
        $connection->query("UPDATE user SET authenticated = 1 WHERE username = '$username' AND auth_code = '$auth_code';");
        echo "You authenticated successfully. You can now go to the login page.<br/>";
    } else {
        echo "Wrong authentication code!<br/>";
    }
}
?>

<html>
<head>
    <title>Authentication</title>
</head>
<body>
    <a href="index.php">Login page</a>
</body>
</html>

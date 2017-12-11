<?php
session_start();

if (isset($_SESSION['user']) && isset($_POST['pw1'])) {
    include "config.php";

    $connection = new mysqli($db_url, $db_username, $db_password, $db_name);

    $username = $_SESSION['user'];
    $password = $_POST['pw1'];

    $connection->query("UPDATE user SET password = '$password' WHERE username = '$username';");

    echo "successfully changed password, you can now return to the login page.<br>";
    echo "<a href='index.php'>Login page</a>";

} else {
    header('Location: index.php');
}

?>
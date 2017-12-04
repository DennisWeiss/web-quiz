<?php
require "PHP-Mailer/Exception.php";
require "PHP-Mailer/PHPMailer.php";
require "PHP-Mailer/SMTP.php";

include "config.php";
include "sendmail.php";

session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

if (isset($_GET['user'])) {
    $username = $_GET['user'];
    $connection = new mysqli($db_url, $db_username, $db_password, $db_name);
    $result = $connection->query("SELECT * FROM user WHERE username = '$username'");
    if ($result->num_rows == 0) {
        echo "The specified user doesn't exist.";
    } else {
        $row = $result->fetch_row();
        if ($row[4] == 1) {
            echo "Account is already authenticated!";
        } else {
            send_email($row[0], $row[1], $row[2], $row[3], $connection);
        }
    }

}

?>
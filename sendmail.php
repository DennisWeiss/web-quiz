<?php
require "PHP-Mailer/Exception.php";
require "PHP-Mailer/PHPMailer.php";
require "PHP-Mailer/SMTP.php";

include "config.php";

$message;

function initialize_mail($msg, $email, $subject) {
    include "config.php";

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    $mail->isSMTP();
    //$mail->SMTPDebug = 5;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->CharSet = "UTF-8";

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Host = $email_host;
    $mail->Port = $email_port;
    $mail->isHTML(true);
    $mail->Username = $email_address;
    $mail->Password = $email_password;
    $mail->setFrom($email_address);
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->addAddress($email);

    return $mail;
}

function reset_pw($username, $email, $auth_code)
{
    $msg = "Hello $username,\n\nClick on the following link to reset your password:\n\nhttp://" + $domain_name + "/reset.php?user=$username&authcode=$auth_code";
    $mail = initialize_mail($msg, $email, "Reset your password");

    try {
        $mail->send();
        $notification = "An e-mail to reset your password has been sent";
    } catch (\PHPMailer\PHPMailer\Exception $exception) {
        echo $exception;
        $notification = "Failed to send e-mail!";
    }

    return $notification;
}

function send_email($username, $email, $password, $auth_code, $connection)
{
    include "config.php";

    $msg =
        "Hello $username,\n\nThank you for registering. Confirm your email-address by clicking on the following link:\n\nhttp://" + $domain_name + "/auth.php?user=$username&authcode=$auth_code";

    $mail = initialize_mail($msg, $email, "Authentication code");

    try {
        $mail->send();
        $connection->query("INSERT INTO user(username, email, password, auth_code, authenticated) VALUES('$username', '$email', '$password', '$auth_code', 0);");
        return true;
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        echo $e;
        return false;
    }
}
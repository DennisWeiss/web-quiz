<?php

function send_email($username, $email, $password, $auth_code, $connection)
{
    include "config.php";

    $msg =
        "Hello $username,\n\nThank you for registering. Confirm your email-address by clicking on the following link:\n\nhttp://localhost/auth.php?user=$username&authcode=$auth_code";
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
    $mail->Subject = "Authentication Code";
    $mail->Body = $msg;
    $mail->addAddress($email);

    try {
        $mail->send();
        $connection->query("INSERT INTO user(username, email, password, auth_code, authenticated) VALUES('$username', '$email', '$password', '$auth_code', 0);");
        echo "An authentication code has been sent to your e-mail address, please confirm your e-mail!";
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        echo "Failed to send email<br>";
        //echo $mail->ErrorInfo;
    }
}
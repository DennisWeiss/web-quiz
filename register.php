<?php
require "PHP-Mailer/Exception.php";
require "PHP-Mailer/PHPMailer.php";
require "PHP-Mailer/SMTP.php";

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

    send_email($email, $username, $email, $password, $auth_code, $connection);

    $connection->close();

}

function send_email($to, $username, $email, $password, $auth_code, $connection) {
    include "config.php";

    $msg = "Hello $username,\n\nThank you for registering. Confirm your email-address by clicking on the following link:\n\nhttp://localhost/auth.php?user=$username&authcode=$auth_code";
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = 5;
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
    $mail->addAddress($to);

    try {
        $mail->send();
        $connection->query("INSERT INTO user(username, email, password, auth_code, authenticated) VALUES('$username', '$email', '$password', '$auth_code', 0);");
        echo "An authentication code has been sent to your e-mail address, please confirm your e-mail!";
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        echo "Failed to send email<br>";
        echo $mail->ErrorInfo;
    }



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

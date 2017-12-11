<?php
include "config.php";
include "sendmail.php";

$message = "";

if (isset($_POST['email'])) {
    $connection = new mysqli($db_url, $db_username, $db_password, $db_name);

    $email = $_POST['email'];

    $result = $connection->query("SELECT username, auth_code FROM user WHERE email = '$email';");

    if ($result->num_rows == 0) {
        $message = "Invalid email-address!";
    } else {
        $row = $result->fetch_row();
        $username = $row[0];
        $authcode = $row[1];
        $message = reset_pw($username, $email, $authcode);
    }
}
?>
<html>
<head>
    <title>Reset your password</title>
</head>
<body>
    <form action="reset-pw.php" method="post">
        <input type="text" name="email" placeholder="Enter your e-mail address">
        <input type="submit" value="Submit">
    </form>
    <div id="message"><?php echo $message; ?></div>
</body>
</html>

<?php
session_start();

if (isset($_GET['user']) && isset($_GET['authcode'])) {
    include "config.php";

    $content = "";

    $connection = new mysqli($db_url, $db_username, $db_password, $db_name);

    $username = $_GET['user'];
    $result = $connection->query("SELECT * FROM users WHERE username = '$username';");

    if ($result->num_rows == 0) {
        $content = "Unknown user";
    } else {
        if ($row[4] == $_GET['authcode']) {
            $content =
                "<form action='change-pw.php'><input type='password' name='pw1' placeholder='New password'><br>" .
                "<input type='password' name='pw2' placeholder='Retype password'><br><input type='submit' value='Submit'></form>";
        } else {
            $content = "Wrong authentication code!";
        }
    }

} else {
    header('Location: reset-pw.php');
}
?>
<html>
<head>
    <title>Reset your password</title>
</head>
<body>
<?php echo $content ?>
</body>
</html>

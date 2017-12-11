<?php
session_start();

if (isset($_GET['user']) && isset($_GET['authcode'])) {
    include "config.php";

    $content = "";

    $connection = new mysqli($db_url, $db_username, $db_password, $db_name);
    $username = $_GET['user'];

    $result = $connection->query("SELECT * FROM user WHERE username = '$username';");

    if ($result->num_rows == 0) {
        $content = "Unknown user";
    } else {
        $row = $result->fetch_row();

        if ($row[3] == $_GET['authcode']) {
            $_SESSION['user'] = $username;
            $content =
                "<form action='change-pw.php' method='post'><input type='password' name='pw1' placeholder='New password'><br>" .
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

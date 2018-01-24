<?php
session_start();

if (isset($_SESSION['user']) && isset($_POST['pw1'])) {

    include "config.php";

    $connection = new mysqli($db_url, $db_username, $db_password, $db_name);

    $username = $_SESSION['user'];

    if ($statement = $connection->prepare("SELECT * FROM user WHERE username=?")) {
        $statement->bind_param("s", $username);
        $statement->execute();
        $statement->bind_result($user, $email, $pw, $authcode, $authenticated);
        $statement->fetch();
        $password = crypt($_POST['pw1'], "$2y$08$" . $authcode);
        $query = "UPDATE user SET password='$password' WHERE username='$username';";
        $connection2 = new mysqli($db_url, $db_username, $db_password, $db_name);
        $connection2->query($query);
        echo "Successfully changed password, you can now return to the Main page.<br>";
        echo "<a href='index.php'>Main page</a>";
    }

} else {
    session_unset();
    header('Location: index.php');
}

?>
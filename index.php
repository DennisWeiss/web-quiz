<?php
const db_url = "localhost";
const db_username = "root";
const db_password = "Meycrosoft1337";
const db_name = "quiz";

session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    echo "Hello $username, you are logged in!<br/>";
    echo "<form action='logout.php' method='post'><br/>";
    echo "<input type='submit' value='Logout'><br/>";
    echo "<input type='hidden' name='logout'>";
} else {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $connection = new mysqli(db_url, db_username, db_password, db_name);
        $username = $_POST['username'];
        if ($result = $connection->query("SELECT * FROM user WHERE username = '$username';")) {
            $row = $result->fetch_row();
            if ($row[2] == $_POST['password']) {
                if ($row[4] == 1) {
                    $_SESSION['user'] = $username;
                    header('Location: index.php');
                } else {
                    echo "User is not yet authenticated!";
                }
            } else {
                echo "Wrong username or wrong password!";
            }
        } else {
            echo "Oops, something went wrong";
        }
    } else {
        echo "<form action='index.php' method='post'>";
        echo "<input type='text' name='username' placeholder='Username or Email'><br/>";
        echo "<input type='password' name='password' placeholder='Password'><br/>";
        echo "<input type='submit' value='Login'>";
        echo "</form>";
        echo "<a href='pw-reset.php'>Forgot your password?</a><br/>";
        echo "<a href='register.php'>Register</a>";

    }
}
?>

<html>
<head>
    <title>Web Quiz</title>
</head>
<body>

</body>
</html>

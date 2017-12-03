<?php
const db_url = "localhost";
const db_username = "root";
const db_password = "Meycrosoft1337";
const db_name = "quiz";

if (isset($_POST['username']) && isset($_POST['password'])) {
    session_start();

    $connection = new mysqli(db_url, db_username, db_password, db_name);
    $username = $_POST['username'];
    $result = $connection->query("SELECT * FROM user WHERE username = $username;");

} else {
    header('Location: index.php');
}

?>
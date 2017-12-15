<?php
include "config.php";

$connection = new mysqli($db_url, $db_username, $db_password);
$connection->query("CREATE DATABASE $db_name");
$connection->query("USE $db_name");

$query1 = $connection->query("CREATE TABLE user(username VARCHAR(30) PRIMARY KEY, email VARCHAR(200) UNIQUE NOT NULL, password VARCHAR(32) NOT NULL, " .
    "auth_code VARCHAR(15), authenticated BIT(1) NOT NULL);");


$successful = 0;

if ($query1) {
    $successful++;

}

if ($successful > 0) {
    echo "Database initialized successfully.";
} else {
    echo "Failed to initialize database!";
}




$connection->close();

?>
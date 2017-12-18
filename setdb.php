<?php
include "config.php";

$connection = new mysqli($db_url, $db_username, $db_password);
$connection->query("CREATE DATABASE $db_name");
$connection->query("USE $db_name");

$query1 = $connection->query("CREATE TABLE user(username VARCHAR(30) PRIMARY KEY, email VARCHAR(200) UNIQUE NOT NULL, password VARCHAR(64) NOT NULL, " .
    "auth_code VARCHAR(22), authenticated BIT(1) NOT NULL);");
$query2 = $connection->query("CREATE TABLE result(username VARCHAR(30) NOT NULL, score INTEGER NOT NULL, " .
    "finished TIMESTAMP NOT NULL, PRIMARY KEY(username, score, finished));");


$successful = 0;

if ($query1) {
    $successful++;
}
if ($query2) {
    $successful++;
}

if ($successful > 0) {
    echo "Database initialized successfully.";
} else {
    echo "Failed to initialize database!";
}




$connection->close();

?>
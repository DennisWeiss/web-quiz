<?php
const db_url = "localhost";
const db_username = "root";
const db_password = "Meycrosoft1337";
$db_name = "quiz";

$connection = new mysqli(db_url, db_username, db_password);
$connection->query("CREATE DATABASE $db_name");
$connection->query("USE $db_name");
$connection->query("CREATE TABLE user(username VARCHAR(30) PRIMARY KEY, email VARCHAR(200) UNIQUE NOT NULL, password VARCHAR(200) NOT NULL, " .
                        "auth_code VARCHAR(15), authenticated BIT(1) NOT NULL);");

echo "Database initialized successfully.";

$connection->close();

?>
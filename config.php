<?php
$config = parse_ini_file("config.ini");

$db_url = $config['db_url'];
$db_username = $config['db_username'];
$db_password = $config['db_password'];
$db_name = $config['db_name'];

$email_host = $config['email_host'];
$email_port = $config['email_port'];
$email_address = $config['email_address'];
$email_password = $config['email_password'];

?>
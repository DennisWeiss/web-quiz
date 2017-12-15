<?php
include "config.php";
include "login.php";


if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$connection = new mysqli($db_url, $db_username, $db_password, $db_name);

ini_set("allow_url_fopen", 1);

$question_json = file_get_contents("https://opentdb.com/api.php?amount=1&category=22&type=multiple");

$obj = json_decode($question_json, true);

echo $obj['results'][0]['question'];

if (isset($_POST['getquiz'])) {


}

?>
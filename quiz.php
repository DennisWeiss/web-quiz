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

$correct_answer = rand(0, 3);

echo $obj['results'][0]['question'] . "<br>";

echo $correct_answer . "<br>";

$answers = array();

for ($i = 0; $i < $correct_answer; $i++) {
    array_push($answers, $obj['results'][0]['incorrect_answers'][$i]);
}

array_push($answers, $obj['results'][0]['correct_answer']);

for ($i = $correct_answer; $i < 3; $i++) {
    array_push($answers, $obj['results'][0]['incorrect_answers'][$i]);
}

print_r($answers);

if (isset($_POST['getquiz'])) {

}

?>
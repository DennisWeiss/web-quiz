<?php
include "config.php";
include "login.php";
include "QuestionResponse.php";
include "ResultResponse.php";


if (isset($_POST['getquiz'])) {
    //$connection = new mysqli($db_url, $db_username, $db_password, $db_name);
    ini_set("allow_url_fopen", 1);
    $question_json = file_get_contents("https://opentdb.com/api.php?amount=1&category=22&type=multiple");
    $obj = json_decode($question_json, true);
    $correct_answer = rand(0, 3);
    $answers = array();
    for ($i = 0; $i < $correct_answer; $i++) {
        array_push($answers, $obj['results'][0]['incorrect_answers'][$i]);
    }
    array_push($answers, $obj['results'][0]['correct_answer']);
    for ($i = $correct_answer; $i < 3; $i++) {
        array_push($answers, $obj['results'][0]['incorrect_answers'][$i]);
    }


    $correct = 'a';
    if ($correct_answer == 1) {
        $correct = 'b';
    } else if ($correct_answer == 2) {
        $correct = 'c';
    } else if ($correct_answer == 3) {
        $correct = 'd';
    }

    $question_response =
        new QuestionResponse(0, $obj['results'][0]['question'], $answers[0], $answers[1], $answers[2], $answers[3],
            $correct);

    echo json_encode($question_response);

}

?>
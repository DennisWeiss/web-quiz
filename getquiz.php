<?php
include "config.php";
include "login.php";
include "QuestionResponse.php";


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

    if (!isset($_SESSION['questionnumber'])) {
        $_SESSION['questionnumber'] = 0;
    }
    if (!isset($_SESSION['correct'])) {
        $_SESSION['correct'] = 0;
    }
    if ($_SESSION['questionnumber'] >= 20) {
        echo "correct: " . $_SESSION['correct'];

        $connection = new mysqli($db_url, $db_username, $db_password, $db_name);

        if ($statement = $connection->prepare("INSERT INTO result(username, score, finished) VALUES (?, ?, ?);")) {
            $user = $_SESSION['user'];
            $amount_correct = $_SESSION['correct'];
            $current_time = date("Y-m-d H:i:s");
            echo $user . "<br>";
            echo $amount_correct . "<br>";
            echo $current_time . "<br>";
            $statement->bind_param("sis", $user, $amount_correct, $current_time);
            $statement->execute();
        }

        unset($_SESSION['questionnumber']);
        unset($_SESSION['correct']);
    } else {
        $_SESSION['questionnumber']++;

        if (isset($_POST['correct'])) {
            if ($_POST['correct'] == "1") {
                $_SESSION['correct']++;
            }
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
            new QuestionResponse($_SESSION['questionnumber'], $obj['results'][0]['question'], $answers[0], $answers[1], $answers[2], $answers[3],
                $correct);

        echo json_encode($question_response);
    }

}

?>
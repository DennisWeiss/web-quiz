<?php

class QuestionResponse
{
    public $type;
    public $questionnumber;
    public $question;
    public $a;
    public $b;
    public $c;
    public $d;
    public $correct;

    /**
     * QuestionResponse constructor.
     * @param $questionnumber int cumulative number of question of current quiz
     * @param $question string question text
     * @param $a string text of answer a
     * @param $b string text of answer b
     * @param $c string text of answer c
     * @param $d string text of answer d
     * @param $correct string from a-d denoting the correct answer
     */
    public function __construct($questionnumber, $question, $a, $b, $c, $d, $correct)
    {
        $this->type = "question";
        $this->questionnumber = $questionnumber;
        $this->question = $question;
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->d = $d;
        $this->correct = $correct;
    }


}
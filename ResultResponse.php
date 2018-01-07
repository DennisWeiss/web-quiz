<?php

class ResultResponse
{
    public $type;
    public $correctly_answered;

    /**
     * ResultResponse constructor.
     * @param $correctly_answered int amount of questions answered correctly
     */
    public function __construct($correctly_answered)
    {
        $this->type = "result";
        $this->correctly_answered = $correctly_answered;
    }
}
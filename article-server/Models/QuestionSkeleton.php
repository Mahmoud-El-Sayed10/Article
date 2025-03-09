<?php

class QuestionSkeleton{
    protected $id;
    protected $question;
    protected $answer;

    protected $table = "questions";

    public function __construct($id = null, $question = null, $answer = null){
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
    }


    public static function create($question, $answer){
        $instance = new static();
        $instance->question = $question;
        $instance->answer = $answer;

        return $instance;
    }

    public function getId(){
        return $this->id;
    }

    public function getquestion(){
        return $this->question;
    }

    public function getanswer(){
        return $this->answer;
    }

    public function getTable(){
        return $this->table;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setQuestion($question){
        $this->question = $question;
    }

    public function setAnswer($answer){
        $this->answer = $answer;
    }

    public function toArray(){
        return [
            "id" => $this->id,
            "question" => $this->question,
            "answer" => $this->answer
        ];
    }
}

?>
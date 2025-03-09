<?php

require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/QuestionSkeleton.php");

class Question extends QuestionSkeleton{

    public static function save($questionObj){
        global $conn;

        if ($questionObj->question && $questionObj->answer){
            try{
                $checkquery = $conn->prepare("SELECT id FROM questions WHERE question = ?");
                $checkquery->bind_param("s", $questionObj->question);
                $checkquery-> execute();
                $result = $checkquery->get_result();

                if ($result->num_rows > 0){
                    return false;
                }
                
                $query = $conn->prepare("INSERT INTO questions (question,answer) VALUES (?,?)");
                $query->bind_param("ss", $questionObj->question, $questionObj->answer);
                $query->execute();

                if($query->affected_rows > 0){
                    $questionObj->id = $conn->insert_id;
                    return true;
            }
        } catch (\Throwable $e){
            return false;
        }
    }
    return false;
}

public static function getQuestions(){
    global $conn;

    try{
        $query = $conn->prepare("SELECT * FROM questions");
        $query->execute();

        $result = $query->get_result();
        $questions = [];

        while($row = $result->fetch_assoc()){
            $questions[] = $row;
        }

        return $questions;
    } catch (\Throwable $e){
        return [];
    }
}
public function toArray(){
    return[
        "id" => $this->id,
        "question" => $this->question,
        "answer" => $this->answer
    ];
}

}
?>
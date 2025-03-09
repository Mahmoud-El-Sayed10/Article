<?php

require(__DIR__ . "/../../connection/connection.php");
require_once(__DIR__ . "/../../Models/Question.php");

$data = json_decode(file_get_contents("php://input"), true);

if(!isset($data["question"]) || !isset($data["answer"])){
    http_response_code(400);
    echo json_encode([
        "message" => "question and answer are required"
    ]);
    exit();
}


$questionText = $data["question"];
$answerText = $data["answer"];

try{
    $question = Question::create($questionText, $answerText);

    if(Question::save($question)){
        echo json_encode([
            "success" => true,
            "question" => $question->toArray()
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "message"=>"Failed to save question"
        ]);
    }
} catch (\Throwable $e){
    http_response_code(500);
    echo json_encode([
        "message" => $e->getMessage()
    ]);
}
?>
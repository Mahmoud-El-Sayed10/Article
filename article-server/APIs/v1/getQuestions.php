<?php

require_once(__DIR__ . "/../../connection/connection.php");
require_once(__DIR__ . "/../../Models/Question.php");

try{
    $questions = Question::getQuestions();

    echo json_encode([
        "success" => true,
        "count" => count($questions),
        "questions" => $questions
    ]);
} catch(\Throwable $e){
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Error retrieving FAQs" .$e->getMessage()
    ]);
}

?>
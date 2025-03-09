<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: POST, DELETE, GET, PUT");

$host = "localhost";
$user = "root";
$password = "";
$db = "article";

$conn = new mysqli($host, $user, $password, $db);

if($conn->connect_error){
    http_response_code(500);
    die(json_encode([
        "success" => false,
        "message" => "Connection error: " . $conn->connect_error
    ]));
}

?>
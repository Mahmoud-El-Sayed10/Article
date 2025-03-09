<?php

require_once(__DIR__ . "/../../connection/connection.php");
require_once(__DIR__ . "/../../Models/User.php");

if(!isset($_POST["email"]) || !isset($_POST["password"])){
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "email and password are required"
    ]);

    exit();
}

$email = $_POST["email"];
$password = $_POST["password"];

try{
    $user = User::login($email, $password);

    if($user){
        echo json_encode([
            "success" => true,
            "user" => $user->toArray(),
        ]);
    } else{
        http_response_code(401);
        echo json_encode([
            "success" => false,
            "message" => "Invalid email or password"
        ]);
    }
} catch (\Throwable $e){
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}

?>
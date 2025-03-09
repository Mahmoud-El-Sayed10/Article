<?php

require_once(__DIR__ . "/../../connection/connection.php");
require_once(__DIR__ . "/../../Models/User.php");

if(!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["fullname"])){
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "email, password and fullname are required"
    ]);

    exit();
}

$email = $_POST["email"];
$password = $_POST["password"];
$fullname = $_POST["fullname"];

try{
  $user = User::create($email, $password, $fullname);

  if(User::save($user)){
      echo json_encode([
          "success" => true,
          "user" => $user->toArray()
      ]);
  } else {
      http_response_code(500);
      echo json_encode([
          "success"=>false,
          "message"=>"Failed to save user"
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
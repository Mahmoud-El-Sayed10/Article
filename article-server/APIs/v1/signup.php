<?php
 require ("../connection.php");

 if(!isset($_POST["email"]) || !isset($_POST["password"])){
    http_response_code(400);
    echo json_encode([
        "message" => "email and password are required"
    ]);
    exit();
 }

 $email = $_POST["email"];
 $password = $_POST["password"];

 //Validation for existing email

 $hashed = hash('sha256', $password);
  try{
    $query = $conn->prepare("INSERT INTO users (email, password) VALUES (?,?)");
    $query->bind_param("ss", $email, $hashed);
    $query->execute();

    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();

    $result = $query->get_result();
    $user = $result->fetch_assoc();

    echo json_encode([
        "user"=>$user,
    ]);
  } catch (\Throwable $e){
        http_response_code(400);

        echo json_encode([
            "message" => $e ->getMessage()
        ]);
  }
?>
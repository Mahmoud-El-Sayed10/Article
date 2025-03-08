<?php

require("../connection.php");

if(!isset($conn) || $con->connect_error){
    die("Invalid connection state: Connection object unavailable or in error state");
}

$tables = [

    "users" => "CREATE TABLE IF NOT EXISTS 'users'(
    'id' INT  AUTO_INCREMENT PRIMARY KEY,
    'fullname' VARCHAR(255) NOT NULL,
    'email' VARCHAR(255) NOT NULL,
    'password' VARCHAR(64) NOT NULL
    )",

    "questions" => "CREATE TABLE IF NOT EXISTS 'questions'(
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'question' TEXT NOT NULL,
    'answer' TEXT NOT NULL,
    )"
];

$migration_success = true;
$execution_log = [];

foreach ($tables as $table_name => $table_query){
    if($conn->query($table_query) === TRUE){
        $execution_log[] = "Table $table_name created successfully";
    } else {
        $migration_success = false;
        $execution_log[] = "Error creating table $table_name: " . $conn->error;
    }
}

echo json_encode([
    "migration_success" => $migration_success,
    "execution_log" => $execution_log
]);

?>
<?php

require(__DIR__ . "/../../connection/connection.php");

if(!isset($conn) || $conn->connect_error){
    die("Invalid connection state: Connection object unavailable or in error state");
}

class CreateQuestionsTable{
    public static function up($conn): void{

        $query = "CREATE TABLE IF NOT EXISTS questions(
            id INT AUTO_INCREMENT PRIMARY KEY,
            question TEXT NOT NULL,
            answer TEXT NOT NULL)";
 
        if ($conn->query($query) === TRUE) {
            echo "Table questions created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
}

CreateQuestionsTable::up($conn);
?>
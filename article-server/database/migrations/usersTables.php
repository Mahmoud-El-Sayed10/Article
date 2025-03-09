<?php

require(__DIR__ . "/../../connection/connection.php");

if(!isset($conn) || $conn->connect_error){
    die("Invalid connection state: Connection object unavailable or in error state");
}

class CreateUserTable{
    public static function up($conn): void{

        $query = "CREATE TABLE IF NOT EXISTS users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            fullname VARCHAR(255) NOT NULL)";

        if ($conn->query($query) === TRUE) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
}

CreateUserTable::up($conn);
?>
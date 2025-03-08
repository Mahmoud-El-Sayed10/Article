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
    die("Connection failed:" . $conn->connect_error);
}

?>
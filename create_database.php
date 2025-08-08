<?php
include 'db_connect.php'; //establish connection to db

//creates database with specified name
$sql = "CREATE DATABASE IF NOT EXISTS school_db";

//check if creation fails, if otherwise, acknowledge db creation
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}else{
    echo "Database Creation Successful.";
}

$conn->close(); //closes db connection
?>
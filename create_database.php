<?php
include 'db_connect'; //establish connection to db

//creates database with specified name
$sql = "CREATE DATABASE school_db";

//check if creation fails
if ($conn->query($sql) === FALSE) {
    echo "Error creating database: " . $conn->error;
}

$conn->close(); //closes db connection
?>
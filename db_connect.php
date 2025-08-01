<?php
//connection credentials + name of database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

//connection command
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error); //check if connection fails
}
?>

<?php
include 'db_connect.php' //establishes connection to mysql database
//create students table
$sql = "CREATE TABLE students(
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100),
        dob DATE,
        gender ENUM('Male','Female','Other'),
        course VARCHAR(50),
        year_level INT,
        contact_number VARCHAR(15),
        email VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

$conn->close(); //close connection
?>
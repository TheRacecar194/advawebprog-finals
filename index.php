<?php
include 'db_connect.php'; //establishes connection to mysql database
//create students table
$sql = "CREATE TABLE IF NOT EXISTS students(
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

//check if table creation fails
if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
}

//set variables to insert to table
$fullName = $_POST['fullName'] ?? "";
$birthDate = $_POST['dateOfBirth'] ?? "";
$gender = $_POST['gender'] ?? "";
$course = $_POST['course'] ?? "";
$yearLevel = $_POST['yearLevel'] ?? "";
$contactNumber = $_POST['contactNumber'] ?? "";
$email = $_POST['email'] ?? "";


//insert to students table
$sql = "INSERT INTO students
(full_name, dob, gender, course, year_level, contact_number, email)
VALUES ('$fullName', '$birthDate', '$gender', '$course', '$yearLevel', '$contactNumber', '$email')";

if($conn->query($sql) === TRUE){
        echo '<script language="javascript">';
        echo 'alert("Student Admission Successful.")';
        echo '</script>';
}else{
        echo '<script language = "javascript">';
        echo 'alert("Error. Please try again.")';
        echo '</script>';
}

$conn->close(); //closes db connection
?>
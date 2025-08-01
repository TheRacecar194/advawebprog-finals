<?php
include 'db_connect.php'; //establishes connection to mysql database
include 'create_table.php'; //potential safeguard for table creation - in case table creation does not happen in linked file.

//set variables to insert to table
$fullName = $_POST['fullName'];
$birthDate = $_POST['dateOfBirth'];
$gender = $_POST['gender'];
$course = $_POST['course'];
$yearLevel = $_POST['yearLevel'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];


//insert to table
$sql = "INSERT INTO students 
        (full_name, dob, gender, course, year_level, contact_number, email) 
        VALUES ('$fullName', '$birthDate', '$gender', '$course', '$yearLevel', '$contactNumber', $email)";

if($conn->query($sql) === TRUE){
        echo '<script language="javascript">';
        echo 'alert("Student Admission Successful.")';
        echo '</script>';
}
?>
<?php
include 'db_connect.php'; //establish connection to db

//fetch all student data
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

//display all data in loop
echo '<h3>Student Data:<>h3'
while($row = $result->fetch_assoc()){
    echo "Student ID: {$row['id']} - Full Name: {$row['full_name']} - Date of Birth: {$row['dob']} - Gender: {$row['gender']} - Course: {$row['course']} - Year Level: {$row['year_level']} - Contact No.: {$row['contact_number']} - Email: {$row['email']}";
}
$conn->close(); //closes db connection
?>
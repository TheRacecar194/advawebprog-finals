<?php
include 'db_connect.php'; //establish connection to db

//fetch all student data
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

//display all data in loop
echo '<h3>Student Data:<h3>';
while($row = $result->fetch_assoc()){
    echo " <br> Student ID: {$row['id']} <br> - Full Name: {$row['full_name']} <br> - Date of Birth: {$row['dob']} <br> - Gender: {$row['gender']} <br> - Course: {$row['course']} <br> - Year Level: {$row['year_level']} <br> - Contact No.: {$row['contact_number']} <br> - Email: {$row['email']}<br>";
}
$conn->close(); //closes db connection
?>
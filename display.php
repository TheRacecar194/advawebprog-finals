<?php
include 'db_connect.php'; //establish connection to db

//fetch all student data
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

//display all data in loop
while($row = $result->fetch_assoc()){
    echo "Student ID: {$row['id']}
     - Full Name: {$row['full_name']}
     - Date of Birth: {$row['dob']}
     - Gender: {$row['gender']}
     - Course: {$row['full_name']}
     - Year Level: {$row['full_name']}
     - Contact No.: {$row['full_name']}
     - Email: {$row['full_name']}";
}
$conn->close(); //closes db connection
?>
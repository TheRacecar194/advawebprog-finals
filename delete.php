<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student </title>
</head>
<body>
    <h2>Delete Student </h2>
    
    <form action="delete.php" method="post">
        <label for="id">Enter Student ID to Delete:</label><br>
        <input type="number" name="id" id="id" required><br><br>
        
        <input type="submit" value="Delete Student">
    </form>
</body>
</html>

.<?php
include 'db_connect.php'; // connect to DB

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $student_id = $_POST['id'];

    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id); 

    if ($stmt->execute()) {
        echo "Student ID $student_id deleted successfully.";
    } else {
        echo "Error deleting student: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid";
}

$conn->close();
?>
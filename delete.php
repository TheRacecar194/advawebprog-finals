<?php
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
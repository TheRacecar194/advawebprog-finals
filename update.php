<?php
include 'db_connect.php'; // Connect to the database

// Get the POST data
$id = $_POST['id'] ?? "";
$fullName = $_POST['fullName'] ?? "";
$birthDate = $_POST['dateOfBirth'] ?? "";
$gender = $_POST['gender'] ?? "";
$course = $_POST['course'] ?? "";
$yearLevel = $_POST['yearLevel'] ?? "";
$contactNumber = $_POST['contactNumber'] ?? "";
$email = $_POST['email'] ?? "";

// Check if required values are present
if (empty($id)) {
    echo '<script>alert("Missing student ID. Cannot update record.");</script>';
    exit;
}

// Prepare the UPDATE SQL
$sql = "UPDATE students 
        SET full_name = ?, dob = ?, gender = ?, course = ?, year_level = ?, contact_number = ?, email = ?
        WHERE id = ?";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssissi", $fullName, $birthDate, $gender, $course, $yearLevel, $contactNumber, $email, $id);

// Execute and give feedback
if ($stmt->execute()) {
    echo '<script>alert("Student record updated successfully.");</script>';
    // Optional: redirect to main page
    // header("Location: index.php");
    // exit;
} else {
    echo '<script>alert("Error updating record: ' . $stmt->error . '");</script>';
}

$stmt->close();
$conn->close();
?>
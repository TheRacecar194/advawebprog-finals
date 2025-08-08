<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student Information</h2>
    <?php if ($student): ?>
    <form method="POST" action="edit_student.php">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">

        <label for="fullName">Full Name:</label><br>
        <input type="text" name="fullName" id="fullName" value="<?= $student['full_name'] ?>" required><br><br>

        <label for="dateOfBirth">Date of Birth:</label><br>
        <input type="date" name="dateOfBirth" id="dateOfBirth" value="<?= $student['dob'] ?>" required><br><br>

        <label>Gender:</label><br>
        <input type="radio" name="gender" value="Male" id="male" <?= $student['gender'] === 'Male' ? 'checked' : '' ?>> <label for="male">Male</label>
        <input type="radio" name="gender" value="Female" id="female" <?= $student['gender'] === 'Female' ? 'checked' : '' ?>> <label for="female">Female</label><br><br>

        <label for="course">Course:</label><br>
        <input type="text" name="course" id="course" value="<?= $student['course'] ?>" required><br><br>

        <label for="yearLevel">Year Level:</label><br>
        <select name="yearLevel" id="yearLevel">
            <option value="1" <?= $student['year_level'] == '1' ? 'selected' : '' ?>>1st Year</option>
            <option value="2" <?= $student['year_level'] == '2' ? 'selected' : '' ?>>2nd Year</option>
            <option value="3" <?= $student['year_level'] == '3' ? 'selected' : '' ?>>3rd Year</option>
            <option value="4" <?= $student['year_level'] == '4' ? 'selected' : '' ?>>4th Year</option>
        </select><br><br>

        <label for="contactNumber">Contact Number:</label><br>
        <input type="text" name="contactNumber" id="contactNumber" value="<?= $student['contact_number'] ?>" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="<?= $student['email'] ?>" required><br><br>

        <input type="submit" value="Update Student">
    </form>
    <?php else: ?>
        <p>No student selected for editing.</p>
    <?php endif; ?>
</body>
</html>

<?php
include 'db_connect.php';

// Phase 1: Fetch existing student data (if GET request with ID)
$student = null;
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();

    if (!$student) {
        echo "<script>alert('Student not found.'); window.location.href='index.php';</script>";
        exit;
    }
}

// Phase 2: Handle form submission (update student)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'] ?? "";
    $fullName = $_POST['fullName'] ?? "";
    $birthDate = $_POST['dateOfBirth'] ?? "";
    $gender = $_POST['gender'] ?? "";
    $course = $_POST['course'] ?? "";
    $yearLevel = $_POST['yearLevel'] ?? "";
    $contactNumber = $_POST['contactNumber'] ?? "";
    $email = $_POST['email'] ?? "";

    if (empty($id)) {
        echo '<script>alert("Missing student ID. Cannot update record.");</script>';
        exit;
    }

    $sql = "UPDATE students 
            SET full_name = ?, dob = ?, gender = ?, course = ?, year_level = ?, contact_number = ?, email = ?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssissi", $fullName, $birthDate, $gender, $course, $yearLevel, $contactNumber, $email, $id);

    if ($stmt->execute()) {
        echo '<script>alert("Student record updated successfully."); window.location.href="index.php";</script>';
        exit;
    } else {
        echo '<script>alert("Error updating record: ' . $stmt->error . '");</script>';
    }

    $stmt->close();
}

$conn->close();
?>
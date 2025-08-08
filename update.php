<?php
include 'db_connect.php';

// If update form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullName = $_POST['fullName'];
    $birthDate = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $yearLevel = $_POST['yearLevel'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];

    $sql = "UPDATE students 
            SET full_name = ?, dob = ?, gender = ?, course = ?, year_level = ?, contact_number = ?, email = ?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);


    $stmt->bind_param("ssssissi", $fullName, $birthDate, $gender, $course, $yearLevel, $contactNumber, $email, $id);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Student record updated successfully.</p>";
    } else {
        echo "<p style='color:red;'>Error updating record: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// If a student is selected to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h2>Select a Student to Edit</h2>
    <form method="get" action="">
        <label for="id">Student ID:</label>
        <input type="number" name="id" required>
        <input type="submit" value="Search">
    </form>

    <?php if (isset($student)) { ?>
        <h2>Edit Student: <?php echo htmlspecialchars($student['full_name']); ?></h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            <label>Full Name:</label><br>
            <input type="text" name="fullName" value="<?php echo htmlspecialchars($student['full_name']); ?>"><br>

            <label>Date of Birth:</label><br>
            <input type="date" name="dateOfBirth" value="<?php echo $student['dob']; ?>"><br>

            <label>Gender:</label><br>
            <select name="gender">
                <option value="Male" <?php if ($student['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($student['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            </select><br>

            <label>Course:</label><br>
            <input type="text" name="course" value="<?php echo htmlspecialchars($student['course']); ?>"><br>

            <label>Year Level:</label><br>
            <input type="number" name="yearLevel" value="<?php echo $student['year_level']; ?>"><br>

            <label>Contact Number:</label><br>
            <input type="text" name="contactNumber" value="<?php echo htmlspecialchars($student['contact_number']); ?>"><br>

            <label>Email:</label><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>"><br>

            <input type="submit" name="update" value="Update Student">
        </form>
    <?php } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) { ?>
        <p style="color:red;">No student found with that ID.</p>
    <?php } ?>
</body>
</html>
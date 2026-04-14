<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    $query = "INSERT INTO marks (student_id, subject, marks)
              VALUES ('$student_id', '$subject', '$marks')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Marks Added Successfully');</script>";
    } else {
        echo "<script>alert('Error adding marks');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Marks</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Add Student Marks</h2>

<form method="POST">
    <label>Select Student:</label><br>
    <select name="student_id" required>
        <option value="">Select Student</option>

        <?php
        $students = mysqli_query($conn, "SELECT * FROM students");
        while ($row = mysqli_fetch_assoc($students)) {
            echo "<option value='" . $row['student_id'] . "'>" . $row['name'] . "</option>";
        }
        ?>
    </select><br><br>

    <label>Subject:</label><br>
    <input type="text" name="subject" required><br><br>

    <label>Marks:</label><br>
    <input type="number" name="marks" required><br><br>

    <button type="submit" name="submit">Add Marks</button>
</form>

<br>
<div style="text-align:center;">
    <a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $query = "INSERT INTO attendance (student_id, date, status)
              VALUES ('$student_id', '$date', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Attendance Marked Successfully');</script>";
    } else {
        echo "<script>alert('Error marking attendance');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="attendance-container">
    <div class="attendance-card">
        <h2>📅 Mark Attendance</h2>

        <form method="POST">
            <label>Select Student:</label>
            <select name="student_id" required>
                <option value="">Select Student</option>

                <?php
                $students = mysqli_query($conn, "SELECT * FROM students");
                while ($row = mysqli_fetch_assoc($students)) {
                    echo "<option value='" . $row['student_id'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select>

            <label>Date:</label>
            <input type="date" name="date" required>

            <label>Status:</label>
            <select name="status" required>
                <option value="">Select Status</option>
                <option value="Present">✅ Present</option>
                <option value="Absent">❌ Absent</option>
            </select>

            <button type="submit" name="submit">Mark Attendance</button>
        </form>

        <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>
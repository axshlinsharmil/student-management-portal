<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $year = $_POST['year'];

    $query = "INSERT INTO students (name, email, department, year)
              VALUES ('$name', '$email', '$department', '$year')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Student Added Successfully');</script>";
    } else {
        echo "<script>alert('Error adding student');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Add Student</h2>

    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Department:</label><br>
        <input type="text" name="department" required><br><br>

        <label>Year:</label><br>
        <input type="text" name="year" required><br><br>

        <button type="submit" name="submit">Add Student</button>
    </form>

    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
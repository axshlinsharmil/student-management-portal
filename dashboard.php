<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href="logout.php" class="top-logout">🚪 Logout</a>
<div class="dashboard-container">
    <h2>Welcome to Student Management Portal</h2>
    <p class="welcome-text">Hello, <?php echo $_SESSION['username']; ?> 👋</p>

    <div class="dashboard-cards">
        <a href="add_student.php" class="card">➕ Add Student</a>
        <a href="view_students.php" class="card">📋 View Students</a>
        
        <a href="add_marks.php" class="card">📝 Add Marks</a>
        <a href="view_marks.php" class="card">📊 View Marks</a>
        <a href="attendance.php" class="card">📅 Attendance</a>
    </div>
</div>

</body>
</html>
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$query = "SELECT marks.id, students.name, marks.subject, marks.marks
          FROM marks
          JOIN students ON marks.student_id = students.student_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Marks</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Student Marks Report</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Subject</th>
        <th>Marks</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['marks']; ?></td>
        </tr>
    <?php } ?>

</table>

<br>
<div style="text-align:center;">
    <a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
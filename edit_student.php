<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$query = "SELECT * FROM students WHERE student_id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $year = $_POST['year'];

    $update_query = "UPDATE students 
                     SET name='$name', email='$email', department='$department', year='$year'
                     WHERE student_id=$id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Student Updated Successfully'); window.location='view_students.php';</script>";
    } else {
        echo "<script>alert('Error updating student');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Edit Student</h2>

    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

        <label>Department:</label><br>
        <input type="text" name="department" value="<?php echo $row['department']; ?>" required><br><br>

        <label>Year:</label><br>
        <input type="text" name="year" value="<?php echo $row['year']; ?>" required><br><br>

        <button type="submit" name="update">Update Student</button>
    </form>

    <br>
    <a href="view_students.php">Back</a>
</body>
</html>
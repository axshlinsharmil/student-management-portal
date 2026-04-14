<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM students WHERE student_id = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Student Deleted Successfully'); window.location='view_students.php';</script>";
    } else {
        echo "<script>alert('Error deleting student'); window.location='view_students.php';</script>";
    }
}
?>
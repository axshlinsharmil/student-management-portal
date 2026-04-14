<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];

    $query = "SELECT * FROM students 
              WHERE name LIKE '%$search%' 
              OR email LIKE '%$search%'";
} else {
    $query = "SELECT * FROM students";
}

$result = mysqli_query($conn, $query);?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Student List</h2>
     <form method="GET" style="width: 300px; margin: 20px auto;">
    <input type="text" name="search" placeholder="Search by name or email">
    <button type="submit">Search</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Year</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['student_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['department']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td>
                    <a href="edit_student.php?id=<?php echo $row['student_id']; ?>">Edit</a> |
                    <a href="delete_student.php?id=<?php echo $row['student_id']; ?>"
                       onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php } ?>

    </table>

    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
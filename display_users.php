<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header('Location: login.php');
    exit();
}
// Database connection
$servername = "localhost";
$username = "root"; // Change if your MySQL username is different
$password = "";     // Change if your MySQL password is not empty
$dbname = "Lab_7";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Users</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Remove old table styles, now using style.css */
    </style>
</head>
<body>
    <h2>Users List</h2>
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['matric']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                echo "<td><a href='update_user.php?matric=" . urlencode($row['matric']) . "'>Update</a> | <a href='delete_user.php?matric=" . urlencode($row['matric']) . "' onclick='return confirm(\"Are you sure?\");'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
$conn->close();
?> 
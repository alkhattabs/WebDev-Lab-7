<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header('Location: login.php');
    exit();
}
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$matric = isset($_GET['matric']) ? $_GET['matric'] : '';
$name = $role = '';
$success = $error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $sql = "UPDATE users SET name=?, role=? WHERE matric=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $role, $matric);
    if ($stmt->execute()) {
        $success = "User updated successfully!";
        header("Location: display_users.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
} else if ($matric) {
    $sql = "SELECT name, role FROM users WHERE matric=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $stmt->bind_result($name, $role);
    $stmt->fetch();
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Update User</h2>
    <?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post" action="">
        <label>Matric</label>
        <input type="text" name="matric" value="<?php echo htmlspecialchars($matric); ?>" readonly><br><br>
        <label>Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>
        <label>Access Level</label>
        <select name="role" required>
            <option value="student" <?php if($role=="student") echo "selected"; ?>>student</option>
            <option value="lecturer" <?php if($role=="lecturer") echo "selected"; ?>>lecturer</option>
        </select><br><br>
        <input type="submit" value="Update">
        <a href="display_users.php">Cancel</a>
    </form>
</body>
</html> 
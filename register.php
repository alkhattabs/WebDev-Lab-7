<?php

$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "Lab_7";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$matric = $name = $user_password = $role = "";
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $name = $_POST["name"];
    $user_password = password_hash($_POST["password"], PASSWORD_DEFAULT); 
    $role = $_POST["role"];

    $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $matric, $name, $user_password, $role);

    if ($stmt->execute()) {
        $success = "Registration successful!";
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Register</h2>
    <?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post" action="">
        <label>Matric:</label>
        <input type="text" name="matric" required><br><br>
        <label>Name:</label>
        <input type="text" name="name" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <label>Role:</label>
        <select name="role" required>
            <option value="">Please select</option>
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html> 

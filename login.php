<?php
session_start();


$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "Lab_7";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $user_password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($user_password, $row['password'])) {
            
            $_SESSION['matric'] = $row['matric'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            header("Location: display_users.php");
            exit();
        } else {
            $error = "Invalid username or password, try <a href='login.php'>login</a> again.";
        }
    } else {
        $error = "Invalid username or password, try <a href='login.php'>login</a> again.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label>Matric:</label>
        <input type="text" name="matric" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <p><a href="register.php">Register here if you have not.</a></p>
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html> 

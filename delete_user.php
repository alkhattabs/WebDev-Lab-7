<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "DELETE FROM users WHERE matric=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
header("Location: display_users.php");
exit(); 

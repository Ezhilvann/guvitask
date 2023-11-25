<?php

$servername = "localhost";
$username = "ezhilvannan";
$password = "ezhilvannan";
$dbname = "guvi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];


$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(['status' => "Login successful!",'id' => $result->fetch_assoc()['id']]);
} else {
    echo "Invalid email or password!";
}

$conn->close();
?>

<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MongoDB\Client;


$userId = (int) $_POST['userId'];


$name = $_POST['name'];
$phoneNumber = $_POST['phoneNumber'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$address = $_POST['address'];


$mysqli = new mysqli("localhost", "ezhilvannan", "ezhilvannan", "guvi");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$updateQuery = "UPDATE users SET name='$name' WHERE id=$userId";
echo($updateQuery."<br>");
$mysqli->query($updateQuery);

$qq = "select * from users where id=$userId";
$res = $mysqli->query($qq);
echo($res->fetch_assoc()['name']);

$mysqli->close();


$mongoClient = new Client("mongodb+srv://ezhilvannan:ezhilvannan@cluster0.7q42spz.mongodb.net/?retryWrites=true&w=majority");
$mongoDatabase = $mongoClient->selectDatabase("users");
$mongoCollection = $mongoDatabase->selectCollection("details");

$updateDocument = [
    'name' => $name,
    'phoneNumber' => $phoneNumber,
    'gender' => $gender,
    'dob' => $dob,
    'address' => $address,
];

$mongoCollection->updateOne(['_id' => $userId], ['$set' => $updateDocument]);

echo 'Profile saved successfully!';
?>

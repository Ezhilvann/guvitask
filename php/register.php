<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Exception;
use MongoDB\Client;

try {
    
    $mongoUri = "mongodb+srv://ezhilvannan:ezhilvannan@cluster0.7q42spz.mongodb.net/?retryWrites=true&w=majority";


    $mysqlHost = "localhost";
    $mysqlUsername = "ezhilvannan";
    $mysqlPassword = "ezhilvannan";
    $mysqlDatabase = "guvi";

    
    $mysqli = new mysqli($mysqlHost, $mysqlUsername, $mysqlPassword, $mysqlDatabase);

    
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "select * from users where email='$email'";
    $ret = $mysqli->query($query);
    if(mysqli_num_rows($ret)>0){
        return "User already registered";
    }
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);
    $stmt->execute();
    $userId = $stmt->insert_id;

    
    
    $mongoClient = new Client($mongoUri);
    $mongoDatabase = $mongoClient->selectDatabase("users");
    $mongoCollection = $mongoDatabase->selectCollection("details");

    
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

    $userDocument = [
        '_id' => $userId,
        'name' => $name,
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        'gender' => $gender,
        'dob' => $dob,
        'address' => $address,
    ];

    $mongoCollection->insertOne($userDocument);
} catch (Exception $e) {
    printf($e->getMessage());
} finally {
    
    if (isset($mysqli)) {
        $mysqli->close();
    }
}
?>

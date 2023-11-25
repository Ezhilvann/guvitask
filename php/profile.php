<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

try {
    
    $mongoUri = "mongodb+srv://ezhilvannan:ezhilvannan@cluster0.7q42spz.mongodb.net/?retryWrites=true&w=majority";

   
    $mongoClient = new Client($mongoUri);
    $mongoDatabase = $mongoClient->selectDatabase("users");
    $mongoCollection = $mongoDatabase->selectCollection("details");

   
    $userId =  (int)$_GET['user'];
    $userDocument = $mongoCollection->findOne(['_id' => $userId]);

    
    echo json_encode($userDocument);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

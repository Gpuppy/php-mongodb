<?php

require 'vendor/autoload.php';

// Connect to MongoDB
//$uri = "mongodb://localhost:27017";
$client = new MongoDB\Client("mongodb://127.0.0.1:27017");


//$client = new MongoDB\Client("mongodb+srv://mongo:<root>@cluster0.mz4dm.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");

// Select a database and a collection
$Database = $client->selectDatabase('php-mongodb');
$Collection = $Database->selectCollection('myCollection');
//$db = $client->selectDatabase('php-mongodb');
//$Collection = $db->selectCollection('myCollection');
echo "yo yoyoy";
/*
// --- CREATE ---
// Insert a document into the "users" collection
$insertResult = $Collection->insertOne([
    'name' => 'Alice',
    'email' => 'alice@example.com'
]);
echo "Inserted user with ID: " . $insertResult->getInsertedId() . "<br>";

// --- READ ---
// Find the document we just inserted
$user = $Collection->findOne(['name' => 'Alice']);
if ($user) {
    echo "User Found: " . $user['name'] . " (" . $user['email'] . ")<br>";
} else {
    echo "User not found.<br>";
}

// --- UPDATE ---
// Update the user's email address
$updateResult = $Collection->updateOne(
    ['name' => 'Alice'],
    ['$set' => ['email' => 'alice_new@example.com']]
);
echo "Matched " . $updateResult->getMatchedCount() . " document(s) and modified " . $updateResult->getModifiedCount() . " document(s).<br>";

// --- DELETE ---
// Delete the user document
$deleteResult = $Collection->deleteOne(['name' => 'Alice']);
echo "Deleted " . $deleteResult->getDeletedCount() . " document(s).<br>";*/


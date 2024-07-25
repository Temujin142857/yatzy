<?php

require __DIR__.'/../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get the Firebase credentials from the environment variable
$firebaseCredentials = json_decode($_ENV['FIREBASE_CREDENTIALS'], true);

// Initialize Firebase
$serviceAccount = ServiceAccount::fromArray($firebaseCredentials);
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://yatzee-4511e-default-rtdb.firebaseio.com/') // Replace with your database URL


$database = $factory->createDatabase();

function getHighScores() {
    error_log('test1', 3, __DIR__.'/logs.txt');
    global $database;
    $value = getValue('HighScores'); // Ensure the correct path is passed
    return $value;
}

function getValue($path) {
    global $database;
    $reference = $database->getReference($path);
    $snapshot = $reference->getSnapshot();
    error_log('data loaded:', 3, __DIR__.'/logs.txt');
    error_log($snapshot, 3, __DIR__.'/logs.txt');

    return $snapshot->getValue();
}

//saving

function savePlayerScore($playerName, $score) {
    global $database;

    // Reference to the HighScores node
    $reference = $database->getReference('HighScores');

    // Update the player's score
    $reference->getChild($playerName)->set($score);

    // Debug: Log the operation
    error_log("Player $playerName scored $score. Data saved to Firebase.");
}



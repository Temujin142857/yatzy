<?php

require __DIR__.'/../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$factory = (new Factory)
    ->withServiceAccount(__DIR__.'/../config/credentials.json')
    ->withDatabaseUri('https://yatzee-4511e-default-rtdb.firebaseio.com/');

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



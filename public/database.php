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
    error_log('test8', 3, __DIR__.'/logs.txt');
    $reference = $database->getReference($path); // Use the $path parameter
    
    // Debug: Log if the reference is correct
    error_log('test4', 3, __DIR__.'/logs.txt');
    
    $snapshot = $reference->getSnapshot();
    
    // Debug: Log the snapshot value
    error_log('other', 3, __DIR__.'/logs.txt');
    
    return $snapshot->getValue();
}

//saving

$database->getReference('HighScores')
    ->set([
        'Tony' => 100,
        'Gator' => 120,
        'Gru' => 140,
    ]);

//$database->getReference('config/website/name')->set('New name');



<?php

require __DIR__.'/vendor/autoload.php';

//retrieval

$database = $factory->createDatabase();

$reference = $database->getReference('path/to/child/location');

$snapshot = $reference->getSnapshot();

$value = $snapshot->getValue();


//saving

$database->getReference('config/website')
    ->set([
        'name' => 'My Application',
        'emails' => [
            'support' => 'support@example.com',
            'sales' => 'sales@example.com',
        ],
        'website' => 'https://app.example.com',
    ]);

$database->getReference('config/website/name')->set('New name');
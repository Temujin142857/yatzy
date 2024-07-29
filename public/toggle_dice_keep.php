<?php
session_start();

// Prevent caching of the response
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Ensure the game state is set
if (!isset($_SESSION['game_state'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Game state not initialized.']);
    exit();
}

// Get the index from the query parameters
if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];

    // Validate the index
    if ($index >= 0 && $index < count($_SESSION['game_state']['dice'])) {
        // Toggle the diceKeep property
        $_SESSION['game_state']['diceKeep'][$index] = !$_SESSION['game_state']['diceKeep'][$index];
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid index.']);
        exit();
    }
}

// Return the updated game state as JSON
header('Content-Type: application/json');
echo json_encode($_SESSION['game_state']);
?>

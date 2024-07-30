<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
include 'YatzyEngine.php';
include 'YatzyGame.php';

use Yatzy\app\models\YatzyGame;
use Yatzy\app\models\YatzyEngine;

// Set response headers
header('Content-Type: application/json');

// Prevent caching of the response
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

// Ensure the category is set
if (!isset($data['category'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Category not specified.']);
    exit();
}

// Ensure the game state is set
if (!isset($_SESSION['game_state'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Game state not initialized.']);
    exit();
}

$category = $data['category'];

// Create or retrieve the game object from session
if (!isset($_SESSION['game'])) {
    $game = new YatzyGame();
    $_SESSION['game'] = serialize($game);
} else {
    $game = unserialize($_SESSION['game']);
}

// Calculate the score for the specified category
try {
    $score = YatzyEngine::scoreTurn($game, $category);

    // Debugging: Print the calculated score
    error_log("Calculated score for category $category: $score");

    // Update the session with the calculated score
    $_SESSION['game_state']['scores'][$category] = $score;

    // Optionally, update the total score
    $_SESSION['game_state']['total_score'] = array_sum($_SESSION['game_state']['scores']);

    // Save the game object back to the session
    $_SESSION['game'] = serialize($game);

    // Return the updated game state as JSON
    echo json_encode([
        'game_state' => $_SESSION['game_state'],
        'score' => $score
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

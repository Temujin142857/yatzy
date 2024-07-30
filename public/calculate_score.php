<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
include 'YatzyEngine.php';
include 'YatzyGame.php';

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

// Get the category from the request
$category = $data['category'];

// Initialize the game state from the session
$game = new YatzyGame();
$game->setDice($_SESSION['game_state']['dice']);
$game->setDiceKeep($_SESSION['game_state']['diceKeep']);
$game->setScore($_SESSION['game_state']['total_score']);

try {
    // Calculate the score for the specified category
    $score = scoreTurn($game, $category);
    $_SESSION['game_state']['scores'][$category] = $score;
    $_SESSION['game_state']['total_score'] += $score;
    
    // Prepare the response data
    $response = [
        'game_state' => $_SESSION['game_state'],
        'score' => $score
    ];
    
    // Output the response as JSON
    echo json_encode($response);
} catch (Exception $e) {
    // Handle any errors that occur during score calculation
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

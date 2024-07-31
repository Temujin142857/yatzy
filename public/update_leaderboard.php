<?php
session_start();

// Initialize the leaderboard if it doesn't exist
if (!isset($_SESSION['leaderboard'])) {
    $_SESSION['leaderboard'] = [];
}

// Get the input data from the request
$data = json_decode(file_get_contents('php://input'), true);
$new_score = $data['score'];
$new_player = isset($data['name']) ? $data['name'] : 'Anonymous';

// Add the new score to the leaderboard
$_SESSION['leaderboard'][] = ['score' => $new_score, 'player' => $new_player];

// Sort the leaderboard in descending order by score
usort($_SESSION['leaderboard'], function($a, $b) {
    return $b['score'] - $a['score'];
});

// Limit the leaderboard to the top 10 scores
$_SESSION['leaderboard'] = array_slice($_SESSION['leaderboard'], 0, 10);

// Return the updated leaderboard as JSON
echo json_encode($_SESSION['leaderboard']);
?>

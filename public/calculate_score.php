<?php
session_start();
include 'yatzy_engine.js';

$data = json_decode(file_get_contents('php://input'), true);
$category = $data['category'];


if (!isset($_SESSION['scores'][$category])) {
    $score = yatzy_engine::scoreTurn($game, $category);
    $_SESSION['scores'][$category] = $score;
    $_SESSION['score'] += $score;
    $_SESSION['dice'] = [0,0,0,0,0];
    $_SESSION['rolls'] = 0;
}

echo json_encode($_SESSION['game_state']);
?>

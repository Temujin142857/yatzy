<?php
session_start();
include 'YatzyEngine.php';

$data = json_decode(file_get_contents('php://input'), true);
echo $data;
$category = $data['category'];
$game = $data['category']
$scoreBox = $data['category']

if (!isset($_SESSION['scores'][$category])) {
    $score = YatzyEngine::scoreTurn($game, $scoreBox);
    $_SESSION['scores'][$category] = $score;
    $_SESSION['score'] += $score;
    $_SESSION['dice'] = [0,0,0,0,0];
    $_SESSION['rolls'] = 0;
}

echo json_encode($_SESSION['game_state']);
?>

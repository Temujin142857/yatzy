<?php
session_start();
include 'YatzyEngine.php';

$data = json_decode(file_get_contents('php://input'), true);
$category = $data['category'];

if (!isset($_SESSION['scores'][$category])) {
    $score = YatzyEngine::scoreTurn($game, $scoreBox);
    $_SESSION['scores'][$category] = $score;
    $_SESSION['score'] += $score;
    $_SESSION['dice'] = array(0,0,0,0,0);
    $_SESSION['rolls'] = 0;
}

echo json_encode($_SESSION['game_state']);
?>

<?php
session_start();
//import the php engine from the models instead of the javascript one

$data = json_decode(file_get_contents('php://input'), true);

$category = $data['category'];
error_log('Received category: ' . $category, 3, __DIR__.'/logs.txt');

if (!isset($_SESSION['scores'][$category])) {
    $score = $Yatzee::scoreTurn($game, $category);
    $_SESSION['scores'][$category] = $score;
    $_SESSION['score'] += $score;
    $_SESSION['dice'] = [0,0,0,0,0];
    $_SESSION['rolls'] = 0;
}

error_log('Received category: ' . $_SESSION['game_state'], 3, __DIR__.'/logs.txt');
echo json_encode($_SESSION['game_state']);
?>

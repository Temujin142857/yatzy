
<?php

require 'database.php';

session_start();


if (!isset($_SESSION['leaderboard'])) {
    $_SESSION['leaderboard'] = [];
}


$data = json_decode(file_get_contents('php://input'), true);
$new_score = $data['score'];
$new_player = isset($data['name']) ? $data['name'] : 'Anonymous';


$_SESSION['leaderboard'][$new_player] = $new_score;

savePlayerScore($new_player, $new_score);

echo json_encode($_SESSION['leaderboard']);
?>
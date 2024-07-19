
<?php
session_start();


if (!isset($_SESSION['leaderboard'])) {
    $_SESSION['leaderboard'] = [];
}


$data = json_decode(file_get_contents('php://input'), true);
$new_score = $data['score'];
$new_player = isset($data['player']) ? $data['player'] : 'Anonymous'; 


$_SESSION['leaderboard'][] = ['score' => $new_score, 'player' => $new_player];


usort($_SESSION['leaderboard'], function ($a, $b) {
    return $b['score'] - $a['score'];
});


$_SESSION['leaderboard'] = array_slice($_SESSION['leaderboard'], 0, 10);


echo json_encode($_SESSION['leaderboard']);
?>

?>
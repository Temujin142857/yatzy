
<?php
session_start();

if (!isset($_SESSION['game_state'])) {
    $_SESSION['game_state'] = [
        'dice' => [0, 0, 0, 0, 0],
        'rolls' => 0,
        'scores' => array_fill_keys(['ones', 'twos', 'threes', 'fours', 'fives', 'sixes', 'three_of_a_kind', 'four_of_a_kind', 'full_house', 'small_straight', 'large_straight', 'chance', 'yatzy'], null),
        'total_score' => 0,
        'diceKeep' => [false, false, false, false, false]
    ];
}

if ($_SESSION['game_state']['rolls'] < 3) {
    for ($i = 0; $i < 5; $i++) {
        if ($_SESSION['game_state']['diceKeep'][$i] === false) {
            $_SESSION['game_state']['dice'][$i] = rand(1, 6);
        }
    }
    $_SESSION['game_state']['rolls']++;
}

echo json_encode($_SESSION['game_state']);
?>

<?php


session_start();

$_SESSION['game_state'] = [
    'dice' => [0, 0, 0, 0, 0],
    'rolls' => 0,
    'scores' => array_fill_keys(['ones', 'twos', 'threes', 'fours', 'fives', 'sixes', 'three_of_a_kind', 'four_of_a_kind', 'full_house', 'small_straight', 'large_straight', 'chance', 'yatzy'], null),
    'total_score' => 0,
    'diceKeep' => array(false,false,false,false,false)    
];



echo json_encode($_SESSION['game_state']);

?>

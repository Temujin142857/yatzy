<?php
session_start();
require 'YatzyEngine.php';

header('Content-Type: application/json');


if (!isset($_SESSION['game_state'])) {
  
    $_SESSION['game_state'] = [
    'dice' => [0, 0, 0, 0, 0],
    'rolls' => 0,
    'scores' => array_fill_keys(['ones', 'twos', 'threes', 'fours', 'fives', 'sixes', 'three_of_a_kind', 'four_of_a_kind', 'full_house', 'small_straight', 'large_straight', 'chance', 'yatzy'], null),
    'total_score' => 0,
    'diceKeep' => array(false,false,false,false,false)
    ];
}

$gameState = $_SESSION['game_state'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
  
       

       
                if (isset($input['category'])) {
                    $category = $input['category'];
                    if ($gameState['scores'][$category] === null) {
                        $score = YatzyEngine::calculateScore($category, $gameState['dice']);
                        $gameState['scores'][$category] = $score;
                        $gameState['total_score'] = YatzyEngine::updateScore($gameState);
                        
                        $gameState['rolls'] = 0;
                        $gameState['dice'] = [0, 0, 0, 0, 0];
                        $gameState['diceKeep'] = array(false, false, false, false, false);
                    }
                }
             
     
        }


$_SESSION['game_state'] = $gameState;


echo json_encode($gameState);
?>

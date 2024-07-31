<?php
session_start();


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
                        $score = scoreTurn($_SESSION['game_state']['dice'], $category);
                        $gameState['scores'][$category] = $score;
                        $gameState['total_score'] = $score;
                        
                        $gameState['rolls'] = 0;
                        $gameState['dice'] = [0, 0, 0, 0, 0];
                        $gameState['diceKeep'] = array(false, false, false, false, false);
                    }
                }
        }


$_SESSION['game_state'] = $gameState;

header('Content-Type: application/json');
error_log('Received category: ' . implode($_SESSION['game_state']['scores']), 3, __DIR__.'/logs.txt');
echo json_encode($_SESSION['game_state']);


    function scoreTurn($game, $scoreBox) {
        switch ($scoreBox) {
            case "ones":
                return numberScore($game, 1);
            case "twos":
                return numberScore($game, 2);
            case "threes":
                return numberScore($game, 3);
            case "fours":
                return numberScore($game, 4);
            case "fives":
                return numberScore($game, 5);
            case "sixes":
                return numberScore($game, 6);
            case "three_of_a_kind":
                return threeOfaKind($game);
            case "four_of_a_kind":
                return fourOfaKind($game);
            case "full_house":
                return fullHouse($game);
            case "small_straight":
                return straight($game, 4);
            case "large_straight":
                return straight($game, 5);
            case "yatzy":
                return fiveOfaKind($game);
            case "chance":
                return array_sum($game->getDice());
            default:
                return 0;
        }
    }

    function numberScore($game, $number) {
        $score = 0;
        foreach ($game as $die) {
            if ($die === $number) {
                $score += $number;
            }
        }
        return $score;
    }

    function threeOfaKind($game) {
        return numOfaKind($game, 3);
    }

    function fourOfaKind($game) {
        return numOfaKind($game, 4);
    }

    function fiveOfaKind($game) {
        return numOfaKind($game, 5) > 0 ? 50 : 0;
    }

    function numOfaKind($game, $num) {        
        $dieMap = array_count_values($game);
        foreach ($dieMap as $value => $count) {
            if ($count >= $num) {
                return array_sum($game);
            }
        }
        return 0;
    }

    function fullHouse($game) {
        $dieMap = array_count_values($game);
        $hasThree = false;
        $hasTwo = false;
        foreach ($dieMap as $count) {
            if ($count === 3) $hasThree = true;
            if ($count === 2) $hasTwo = true;
        }
        return $hasThree && $hasTwo ? 25 : 0;
    }

    function straight($game, $length) {
        $dice = array_unique($game);
        sort($dice);
        $consecutive = 1;
        for ($i = 1; $i < count($dice); $i++) {
            if ($dice[$i] === $dice[$i - 1] + 1) {
                $consecutive++;
                if ($consecutive === $length) {
                    return $length === 4 ? 30 : 40;
                }
            } else {
                $consecutive = 1;
            }
        }
        return 0;
    }


echo json_encode($gameState);
?>

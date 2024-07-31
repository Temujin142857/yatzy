<?php

namespace Yatzy\app\models;

class YatzyEngine {
    public static function scoreTurn($game, $scoreBox) {
        switch ($scoreBox) {
            case "ones":
                return self::numberScore($game, 1);
            case "twos":
                return self::numberScore($game, 2);
            case "threes":
                return self::numberScore($game, 3);
            case "fours":
                return self::numberScore($game, 4);
            case "fives":
                return self::numberScore($game, 5);
            case "sixes":
                return self::numberScore($game, 6);
            case "three_of_a_kind":
                return self::threeOfaKind($game);
            case "four_of_a_kind":
                return self::fourOfaKind($game);
            case "full_house":
                return self::fullHouse($game);
            case "small_straight":
                return self::straight($game, 4);
            case "large_straight":
                return self::straight($game, 5);
            case "yatzy":
                return self::fiveOfaKind($game);
            case "chance":
                return array_sum($game->getDice());
            default:
                return 0;
        }
    }

    private static function numberScore($game, $number) {
        $score = 0;
        foreach ($game->getDice() as $die) {
            if ($die === $number) {
                $score += $number;
            }
        }
        return $score;
    }

    private static function threeOfaKind($game) {
        return self::numOfaKind($game, 3);
    }

    private static function fourOfaKind($game) {
        return self::numOfaKind($game, 4);
    }

    private static function fiveOfaKind($game) {
        return self::numOfaKind($game, 5) > 0 ? 50 : 0;
    }

    private static function numOfaKind($game, $num) {
        $dice = $game->getDice();
        $dieMap = array_count_values($dice);
        foreach ($dieMap as $value => $count) {
            if ($count >= $num) {
                return array_sum($dice);
            }
        }
        return 0;
    }

    private static function fullHouse($game) {
        $dice = $game->getDice();
        $dieMap = array_count_values($dice);
        $hasThree = false;
        $hasTwo = false;
        foreach ($dieMap as $count) {
            if ($count === 3) $hasThree = true;
            if ($count === 2) $hasTwo = true;
        }
        return $hasThree && $hasTwo ? 25 : 0;
    }

    private static function straight($game, $length) {
        $dice = array_unique($game->getDice());
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
}

?>

<!DOCTYPE html>
<html>
<body>

<?php

use Yatzy\app\models\YatzeeGame;

function scoreTurn($game, $scoreBox){
    switch ($scoreBox) {
        case "ones":
            return numberScore($game, 1);
        case "twos":
            return numberScore($game, 2);
        case "threes":
            return  numberScore($game, 3);
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
            return straight($game,4);
        case "large_straight":
            return straight($game,5);
        case "yatzee":
            return fiveOfaKind($game);
        case "chance":
            $score=0;
            foreach ($game -> getDice() as $die) {
                $score+=$die;
            }
            return $score;
    }
}


function numberScore($game, $number){
    $score=0;
    foreach ($game -> getDice() as $die) {
        if($die===$number){
            $score+=$number;
        }
    }
    return $score;
}

function straight($game, $number){
    $dice=$game->getdice();
    if(straightCheck($dice, $dice[0])>=$number){
        return $number===4? 30:40;
    }
    else return 0;

}

function straightCheck($game, $die){
    $dice=$game->getdice();
    $num=1;
    if(in_array($die+1, $dice)){        
        $num+=straightCheck(array_filter($dice,function($d){global $die;return $d!=$die+1;}),$die+1);
    }
    if(in_array($die-1, $dice)){
        $num+=straightCheck(array_filter($dice,function($d){global $die;return $d!=$die-1;}),$die-1);
    }
    return $num;
}

function threeOfaKind($game){
    return numOfaKind($game, 3);
}

function fourOfaKind($game){
    return numOfaKind($game, 4);
}

function fiveOfaKind($game){
    return numOfaKind($game, 5)>0? 50:0;
}

function numOfaKind($game, $num){
    $dice=$game->getDice();
    $goodCount=false;
    $score=0;
    $dieMap=dieMapper($dice);
    array_map(function($value, $key){
        global $goodCount;
        global $score;
        global $num;
        $score+=$key;
        if($value>=$num)$goodCount=true;
    }, $dieMap);
    return goodCount? score:0;
}

function fullHouse($game){
    $pair=false;
    $three=false;
    $dieMap=dieMapper(dice);
    array_map(function($value, $key){
        if($value===2)$pair=true;
        else if($value===3)$three=true;
    }, $dieMap);
    return ($three&&$pair)? 25:0;
}

function dieMapper($game){
    $dice=$game->getDice();
    $dieMap= [];
    foreach ($dice as $die){
        if(!array_in($die, $dieMap)){
            $dieMap[$die]=1;
        }else{
            $dieMap[$die]+=1;
        }
    }
    return $dieMap;
}

function getScore($game){
return $game->getScore();
}



?>

</body>
</html>
<!DOCTYPE html>
<html>
<body>

<?php

use Yatzy\app\models\Dice;

$d = new Dice();

$r=0;
$dice=array(0,0,0,0,0);
$diceKeep=array(false,false,false,false,false);
$score=0;

function rollDice(){
    global $d, $dice, $diceKeep;
    for ($i = 0; $i <= 5; $i++) {
        if(!$diceKeep[i]){
            $dice[i]=$d->roll();
        }
    }
}

function toggleDiceLock($i){
    global $diceKeep;
    $diceKeep[$i]=!$diceKeep[$i];
}
    
function getDice(){
    global $dice;
    return $dice;
}

function getScore(){
    global $score;
    return $score;  
}

function setScore($n){
    global $score;
    $score=$n;
}

?>

</body>
</html>
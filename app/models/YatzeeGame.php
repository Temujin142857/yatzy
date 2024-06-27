<!DOCTYPE html>
<html>
<body>

<?php

use Yatzy\Dice;

$d = new Dice();

$r=0;
$dice=array(0,0,0,0,0);
$diceKeep=array(false,false,false,false,false);

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
    

?>

</body>
</html>
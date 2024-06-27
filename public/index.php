<!DOCTYPE html>
<html>
<body>

<?php
require_once('_config.php');

use Yatzy\app\models\Dice;

$d = new Dice();

for ($i=1; $i<=5; $i++) {
  echo "ROLL {$i}: {$d->roll()}<br>";
}

use Yatzy\app\models\YatzeeGame;

$game = new YatzeeGame();

for ($i= 1; $i<= 5; $i++) {
    $game->roll();
    foreach ($game -> getDice() as $die) {
        echo "{$die} "; 
        $game->toggleDiceLock(i);   
    }
    echo "<br>";
}


?>

</body>
</html>
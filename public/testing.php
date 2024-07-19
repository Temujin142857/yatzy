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

use Yatzy\app\models\YatzeeEngine;

$game = new YatzeeEngine();
$game->roll();

$scoreBox = "full_house"; 
$score = scoreTurn($game, $scoreBox);
echo "<p>Score for {$scoreBox}: {$score}</p>";

$scoreBox = "yatzee";
$score = scoreTurn($game, $scoreBox);
echo "<p>Score for {$scoreBox}: {$score}</p>";
?>

?>

</body>
</html>
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
?>

</body>
</html>
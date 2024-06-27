
<?php

use PHPUnit\Framework\TestCase;
use Yatzy\app\models\YatzeeGame;

class YatzeeGameTest extends TestCase
{
   
    public function testRollDice()
    {
        $game = new YatzeeGame();
        
        $game->rollDice();
        
        foreach ($game->getDice() as $die) {
            $this->assertGreaterThanOrEqual(1, $die);
            $this->assertLessThanOrEqual(6, $die);
        }
    }

    public function testToggleDiceLock()
    {
        $game = new YatzeeGame();
        
        $game->rollDice();
        
        $die= $game->getDice()[0];

        toggleDiceLock(0);
        $game->rollDice();
        $this->assertTrue($die==$game->getDice()[0]);
    }

}

<?php
        
use Yatzy\app\models\Dice;
use PHPUnit\Framework\TestCase;

class DiceTest extends TestCase
{


    public function testRoll()
    {
        $d = new Dice();

        for ($i = 0; $i < 100; $i++) {
            $result = $d->roll();
            $this->assertGreaterThanOrEqual(1, $result);
            $this->assertLessThanOrEqual(6, $result);
        }
    }
}

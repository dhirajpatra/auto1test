<?php
declare(strict_types=1);

require_once __DIR__ . '/Fight.php';

/**
 * Class FightTest
 */
class FightTest extends PHPUnit\Framework\TestCase {

    /**
     * test makeFight method Fight class
     */
    public function testMakeFight()
    {
        $result = 0;
        $fight = $this->getMockBuilder(\Fight::class)->getMock();
        $heroInterface = $this->getMockBuilder(\HeroInterface::class)->getMock();
        $fight->expects($this->any())
            ->method('makeFight')
            ->with($heroInterface, $heroInterface)
            ->will($this->returnValue($result));

        $this->assertInternalType("int", $result);
    }

}

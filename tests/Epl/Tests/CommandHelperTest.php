<?php

namespace Epl;

use Epl\CommandHelper as Command;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CommandTest extends \PHPUnit_Framework_TestCase
{
    private $composite;
    public function setUp()
    {
        $this->composite = new CommandComposite();
    }

    /**
     * @test
     */
    public function toEplString()
    {
        $command = new Command($this->composite);
        $command->asciiText(1, 1, 90, 1, 1, 1, false, 'TEST', true, false)
                ->barCode(1, 1, 90, 1, 1, 2, 1, true, 'TEST', true)
                ->rss14BarCode(1, 1, 0, 'RL', 1, 2, 1, false, '"123456789"', true)
                ->density(15);
        $this->assertEquals('A1,1,1,1,1,1,N,"TEST"' . chr(10)
                           .'B1,1,1,1,1,2,1,B,"TEST"' . chr(10)
                           .'B1,1,0,RL,1,2,1,N,"\"123456789\""' . chr(10)
                           .'D15' . chr(10)
                           , $command->toEplString());
    }
}

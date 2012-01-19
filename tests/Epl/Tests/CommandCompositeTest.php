<?php

namespace Epl\Tests;

use Epl\CommandComposite;
use Epl\Command\Image\ClearImageBufferCommand;
use Epl\Command\Stored\SpeedCommand;
use Epl\Command\PrintCommand;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CommandCompositeTest extends \PHPUnit_Framework_TestCase
{
    public function providerIsValidIntegerInterval()
    {
        return array (
            array ('name', 1, 0, 2, true)
        );
    }

    /**
     * @test
     */
    public function toEplString()
    {
        $clearImageBuffer = new ClearImageBufferCommand();
        $speed = new SpeedCommand(1);
        $print = new PrintCommand(1);
        $command = new CommandComposite();
        $command->addCommand($clearImageBuffer);
        $command->addCommand($speed);
        $command->addCommand($print);

        $this->assertInstanceOf('Epl\\CommandCompositeInterface', $command);
        $this->assertEquals(3, count($command->getCommands()));
        foreach ($command->getCommands() as $commandEpl) {
            $this->assertInstanceOf('Epl\\CommandInterface', $commandEpl);
        }
        $this->assertEquals(chr(10) . 'N' . chr(10) . 'S1' . chr(10) . 'P1' . chr(10), $command->toEplString());
        $command->clearCommands();
        $this->assertEquals(0, count($command->getCommands()));
        $this->assertNull($command->toEplString());
    }
}

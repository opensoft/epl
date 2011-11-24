<?php

namespace Epl\Tests;

use Epl\CommandFacade;
use Epl\Command\Image\ClearImageBufferCommand;
use Epl\Command\Stored\SpeedCommand;
use Epl\Command\PrintCommand;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CommandFacadeTest extends \PHPUnit_Framework_TestCase
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
        $command = new CommandFacade();
        $command->addCommand($clearImageBuffer);
        $command->addCommand($speed);
        $command->addCommand($print);

        $this->assertInstanceOf('Epl\\CommandFacadeInterface', $command);
        $this->assertEquals(3, count($command->getCommands()));
        foreach ($command->getCommands() as $commandEpl) {
            $this->assertInstanceOf('Epl\\CommandInterface', $commandEpl);
        }
        $this->assertEquals(chr(13) . chr(10) . 'N' . chr(13) . chr(10) . 'S1' . chr(13) . chr(10) . 'P1' . chr(13) . chr(10), $command->toEplString());
    }
}

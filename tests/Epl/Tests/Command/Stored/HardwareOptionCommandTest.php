<?php

namespace Epl\Tests\Command\Stored;

use Epl\Command\Stored\HardwareOptionCommand as Command;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class HardwareOptionCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function toEplString()
    {
        $command = new Command('C');
        $this->assertEquals(Command::NAME . 'C' . chr(10), $command->toEplString());

        $command = new Command('C', 'b');
        $this->assertEquals(Command::NAME . 'Cb' . chr(10), $command->toEplString());

        $command = new Command('C', 1);
        $this->assertEquals(Command::NAME . 'C1' . chr(10), $command->toEplString());

        $command = new Command('C', 255);
        $this->assertEquals(Command::NAME . 'C255' . chr(10), $command->toEplString());

        $command = new Command('D');
        $this->assertEquals(Command::NAME . 'D' . chr(10), $command->toEplString());

        $command = new Command('d');
        $this->assertEquals(Command::NAME . 'd' . chr(10), $command->toEplString());

        $command = new Command('P');
        $this->assertEquals(Command::NAME . 'P' . chr(10), $command->toEplString());

        $command = new Command('L');
        $this->assertEquals(Command::NAME . 'L' . chr(10), $command->toEplString());

        $command = new Command('S');
        $this->assertEquals(Command::NAME . 'S' . chr(10), $command->toEplString());

        $command = new Command('F', 'f');
        $this->assertEquals(Command::NAME . 'Ff' . chr(10), $command->toEplString());

        $command = new Command('F', 'r');
        $this->assertEquals(Command::NAME . 'Fr' . chr(10), $command->toEplString());

        $command = new Command('F', 'i');
        $this->assertEquals(Command::NAME . 'Fi' . chr(10), $command->toEplString());
    }

    /**
     * @test
     * @dataProvider providerToEplStringException
     * @expectedException \Epl\ExceptionCommand
     */
    public function toEplStringException($option, $additionalOption)
    {
        $command = new Command($option, $additionalOption);
    }

    public function providerToEplStringException()
    {
        return array(
            array(6, null),
            array('c', null),
            array('C', 'c'),
            array('C', 'B'),
            array('C', 0),
            array('C', 256),
            array('F', null),
            array('F', 'F'),
            array('F', 'R'),
            array('F', 'I'),
            array('F', 'P'),
            array('D', 'P'),
            array('d', 'P'),
            array('P', 'P'),
            array('L', 'P'),
            array('S', 'P'),
        );
    }
}

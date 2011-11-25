<?php

namespace Epl\Tests\Command\Stored;

use Epl\Command\Stored\SetFormLengthCommand as Command;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class SetFormLengthCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($labelLength, $gapLength, $offsetLength, $expectedResult)
    {
        $command = new Command($labelLength, $gapLength, $offsetLength);
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array(0, 20, null, Command::NAME . '0,20' . chr(10)),
            array(65535, 20, null, Command::NAME . '65535,20' . chr(10)),
            array(60, 16, null, Command::NAME . '60,16' . chr(10)),
            array(60, 240, null, Command::NAME . '60,240' . chr(10)),
            array(6, 24, 24, Command::NAME . '6,24+24' . chr(10)),
            array(6, 24, 0, Command::NAME . '6,24+0' . chr(10)),
            array(6, 24, 65535, Command::NAME . '6,24+65535' . chr(10)),
        );
    }

    /**
     * @test
     * @dataProvider providerToEplStringException
     * @expectedException \Epl\ExceptionCommand
     */
    public function toEplStringException($labelLength, $gapLength, $offsetLength)
    {
        $command = new Command($labelLength, $gapLength, $offsetLength);
    }

    public function providerToEplStringException()
    {
        return array(
            array(-1, 20, null),
            array(65536, 20, null),
            array(1, 15, null),
            array(1, 241, null),
            array(1, 20, -1),
            array(1, 20, 65536)
        );
    }
}

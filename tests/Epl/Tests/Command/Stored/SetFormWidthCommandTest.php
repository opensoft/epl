<?php

namespace Epl\Tests\Command\Stored;

use Epl\Command\Stored\SetFormWidthCommand as Command;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($width, $expectedResult)
    {
        $command = new Command($width);
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array('0', Command::NAME . '0' . chr(13) . chr(10)),
            array('2', Command::NAME . '2' . chr(13) . chr(10)),
            array(1, Command::NAME . '1' . chr(13) . chr(10)),
            array('sdf', Command::NAME . '0' . chr(13) . chr(10)),
            array(345, Command::NAME . '345' . chr(13) . chr(10)),

        );
    }
}

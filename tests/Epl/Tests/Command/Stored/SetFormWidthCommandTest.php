<?php

namespace Epl\Tests\Command\Stored;

use Epl\Command\Stored\SetFormWidthCommand as Command;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class SetFormWidthCommandTest extends \PHPUnit_Framework_TestCase
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
            array('0', 'q0' . chr(10)),
            array('2', 'q2' . chr(10)),
            array(1, 'q1' . chr(10)),
            array('sdf', 'q0' . chr(10)),
            array(345, 'q345' . chr(10)),

        );
    }
}

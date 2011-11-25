<?php

namespace Epl\Tests\Command\Stored;

use Epl\Command\Stored\DensityCommand as Command;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class DensityCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($density, $expectedResult)
    {
        $command = new Command($density);
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array(0, Command::NAME . '0' . chr(10)),
            array(15, Command::NAME . '15' . chr(10))
        );
    }

    /**
     * @test
     * @dataProvider providerToEplStringException
     * @expectedException \Epl\ExceptionCommand
     */
    public function toEplStringException($density)
    {
        $command = new Command($density);
    }

    public function providerToEplStringException()
    {
        return array(
            array(-1),
            array(16)
        );
    }
}

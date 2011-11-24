<?php

namespace Epl\Tests\Command\Stored;

use Epl\Command\Stored\SpeedCommand;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class SpeedCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($speed, $expectedResult)
    {
        $command = new SpeedCommand($speed);
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array(1, SpeedCommand::NAME . '1' . chr(13) . chr(10)),
            array(0, SpeedCommand::NAME . '0' . chr(13) . chr(10))
        );
    }
}

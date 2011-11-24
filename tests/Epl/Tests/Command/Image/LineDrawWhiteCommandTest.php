<?php

namespace Epl\Tests\Command\Image;

use Epl\Command\Image\LineDrawWhiteCommand as Command;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class LineDrawWhiteCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength, $expectedResult)
    {
        $command = new Command($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength);
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array(10, 10, 20, 200, Command::NAME . '10,10,20,200' . chr(13) . chr(10)),
            array(false, true, 'sss', 1, Command::NAME . '0,1,0,1' . chr(13) . chr(10))
        );
    }
}

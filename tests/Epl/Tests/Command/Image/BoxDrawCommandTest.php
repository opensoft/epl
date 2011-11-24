<?php

namespace Epl\Tests\Command\Image;

use Epl\Command\Image\BoxDrawCommand;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class BoxDrawCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($horizontalStartPosition, $verticalStartPosition, $lineThickness,
                                $horizontalEndPosition, $verticalEndPosition, $expectedResult)
    {
        $command = new BoxDrawCommand($horizontalStartPosition, $verticalStartPosition, $lineThickness,
                                      $horizontalEndPosition, $verticalEndPosition);
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array(1,1,1,1,1, BoxDrawCommand::NAME . '1,1,1,1,1' . chr(13) . chr(10)),
            array(false,'ss',2.5,2,1, BoxDrawCommand::NAME . '0,0,2,2,1' . chr(13) . chr(10))
        );
    }
}

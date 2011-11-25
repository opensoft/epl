<?php

namespace Epl\Tests\Command\Image;

use Epl\Command\Image\BarCodeCommand;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class BarCodeCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                                    $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation, $expectedResult)
    {
        $command = new BarCodeCommand($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                                      $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation);
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array(1, 1, 90, 1, 1, 2, 1, true, 'TEST', true, BarCodeCommand::NAME . '1,1,1,1,1,2,1,B,"TEST"' . chr(10)),
            array(1, 1, 180, 1, 1, 2, 1, true, 'TEST', true, BarCodeCommand::NAME . '1,1,2,1,1,2,1,B,"TEST"' . chr(10)),
            array(1, 1, 270, 1, 1, 2, 1, true, 'TEST', true, BarCodeCommand::NAME . '1,1,3,1,1,2,1,B,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 2, 1, true, 'TEST', true, BarCodeCommand::NAME . '1,1,0,1,1,2,1,B,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 2, 1, true, 'TEST', null, BarCodeCommand::NAME . '1,1,0,1,1,2,1,B,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 2, 1, true, 'TEST', false, BarCodeCommand::NAME . '1,1,0,1,1,2,1,B,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 2, 1, false, 'TEST', true, BarCodeCommand::NAME . '1,1,0,1,1,2,1,N,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 2, 1, false, 'TE\ST', true, BarCodeCommand::NAME . '1,1,0,1,1,2,1,N,"TE\\\\ST"' . chr(10)),
            array(1, 1, 0, 1, 1, 2, 1, false, '"TEST"', true, BarCodeCommand::NAME . '1,1,0,1,1,2,1,N,"\"TEST\""' . chr(10)),
        );
    }

    /**
     * @test
     * @expectedException \Epl\ExceptionCommand
     * @dataProvider providerToEplStringException
     */
    public function toEplStringException($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                                         $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation)
    {
        $command = new BarCodeCommand($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                                      $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation);
        $command->toEplString();
    }

    public function providerToEplStringException()
    {
        return array(
            array(1, 1, -90, 1, 1, 2, 1, true, 'TEST', true),
            array(1, 1, 180, -21, 2, 2, 1, true, 'TEST', true),
            array(1, 1, 270, 1, 22, 10, 1, true, 'TEST', true),
            array(1, 1, 0, 1, 1, 1222, 122, true, 'TEST', true),
        );
    }
}

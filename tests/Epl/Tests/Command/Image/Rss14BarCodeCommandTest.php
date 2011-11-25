<?php

namespace Epl\Tests\Command\Image;

use Epl\Command\Image\Rss14BarCodeCommand;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class Rss14BarCodeCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                                    $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation, $expectedResult)
    {
        $command = new Rss14BarCodeCommand($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                                      $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation);
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array(1, 1, 90, 'R14', 1, 2, 1, true, '123456789', true, 'B1,1,1,R14,1,2,1,B,"123456789"' . chr(10)),
            array(1, 1, 180, 'R14', 1, 2, 1, true, '123456789', true, 'B1,1,2,R14,1,2,1,B,"123456789"' . chr(10)),
            array(1, 1, 270, 'R14', 1, 2, 1, true, '123456789', true, 'B1,1,3,R14,1,2,1,B,"123456789"' . chr(10)),
            array(1, 1, 0, 'RL', 1, 2, 1, true, '123456789', true, 'B1,1,0,RL,1,2,1,B,"123456789"' . chr(10)),
            array(1, 1, 0, 'RS', 1, 2, 1, true, '123456789', null, 'B1,1,0,RS,1,2,1,B,"123456789"' . chr(10)),
            array(1, 1, 0, 'RT', 1, 2, 1, true, '123456789', false, 'B1,1,0,RT,1,2,1,B,"123456789"' . chr(10)),
            array(1, 1, 0, 'RT', 1, 2, 1, false, '123456789', true, 'B1,1,0,RT,1,2,1,N,"123456789"' . chr(10)),
            array(1, 1, 0, 'RS', 1, 2, 1, false, 'TE\ST', true, 'B1,1,0,RS,1,2,1,N,"TE\\\\ST"' . chr(10)),
            array(1, 1, 0, 'RL', 1, 2, 1, false, '"123456789"', true, 'B1,1,0,RL,1,2,1,N,"\"123456789\""' . chr(10)),
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
        $command = new Rss14BarCodeCommand($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                                      $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation);
        $command->toEplString();
    }

    public function providerToEplStringException()
    {
        return array(
            array(1, 1, -90, 'RT', 1, 2, 1, true, '123456789', true),
            array(1, 1, 180, -21, 2, 2, 1, true, '123456789', true),
            array(1, 1, 270, 'RT', 22, 10, 1, true, '123456789', true),
            array(1, 1, 0, 'RT', 1, 1222, 122, true, '123456789', true),
        );
    }
}

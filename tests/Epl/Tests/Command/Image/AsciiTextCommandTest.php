<?php

namespace Epl\Tests\Command\Image;

use Epl\Command\Image\AsciiTextCommand as Command;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class AsciiTextCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($horizontalStartPosition, $verticalStartPosition, $rotation, $fontSelection,
                                $horizontalMultiplier, $verticalMultiplier, $reverseImage, $data, $convertRotation,
                                $asianFont, $expectedResult)
    {
        $command = new Command($horizontalStartPosition, $verticalStartPosition, $rotation, $fontSelection,
                               $horizontalMultiplier, $verticalMultiplier, $reverseImage, $data, $convertRotation,
                               $asianFont);
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array(1, 1, 90, 1, 1, 1, false, 'TEST', true, false, Command::NAME . '1,1,1,1,1,1,N,"TEST"' . chr(10)),
            array(1, 1, 180, 1, 1, 1, false, 'TEST', true, false, Command::NAME . '1,1,2,1,1,1,N,"TEST"' . chr(10)),
            array(1, 1, 270, 1, 1, 1, false, 'TEST', true, false, Command::NAME . '1,1,3,1,1,1,N,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,1,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 90, 1, 1, 1, false, 'TEST', true, true, Command::NAME . '1,1,5,1,1,1,N,"TEST"' . chr(10)),
            array(1, 1, 180, 1, 1, 1, false, 'TEST', true, true, Command::NAME . '1,1,6,1,1,1,N,"TEST"' . chr(10)),
            array(1, 1, 270, 1, 1, 1, false, 'TEST', true, true, Command::NAME . '1,1,7,1,1,1,N,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 1, true, 'TEST', true, true, Command::NAME . '1,1,4,1,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 1, true, 'TEST', null, false, Command::NAME . '1,1,0,1,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 1, true, 'TEST', false, false, Command::NAME . '1,1,0,1,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 1, false, 'TEST', true, false, Command::NAME . '1,1,0,1,1,1,N,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 1, false, 'TE\ST', true, false, Command::NAME . '1,1,0,1,1,1,N,"TE\\\\ST"' . chr(10)),
            array(1, 1, 0, 1, 1, 1, false, '"TEST"', true, false, Command::NAME . '1,1,0,1,1,1,N,"\"TEST\""' . chr(10)),
            array(1, 1, 0, 2, 1, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,2,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 3, 1, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,3,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 4, 1, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,4,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 5, 1, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,5,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 6, 1, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,6,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 7, 1, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,7,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 8, 1, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,8,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 9, 1, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,9,1,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 2, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,1,2,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 3, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,1,3,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 4, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,1,4,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 5, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,1,5,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 6, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,1,6,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 8, 1, true, 'TEST', true, false, Command::NAME . '1,1,0,1,8,1,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 2, true, 'TEST', true, false, Command::NAME . '1,1,0,1,1,2,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 3, true, 'TEST', true, false, Command::NAME . '1,1,0,1,1,3,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 4, true, 'TEST', true, false, Command::NAME . '1,1,0,1,1,4,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 5, true, 'TEST', true, false, Command::NAME . '1,1,0,1,1,5,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 6, true, 'TEST', true, false, Command::NAME . '1,1,0,1,1,6,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 7, true, 'TEST', true, false, Command::NAME . '1,1,0,1,1,7,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 8, true, 'TEST', true, false, Command::NAME . '1,1,0,1,1,8,R,"TEST"' . chr(10)),
            array(1, 1, 0, 1, 1, 9, true, 'TEST', true, false, Command::NAME . '1,1,0,1,1,9,R,"TEST"' . chr(10)),
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
        $command = new Command($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                                      $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation);
        $command->toEplString();
    }

    public function providerToEplStringException()
    {
        return array(
            array(1, 1, -90, 1, 1, 1, true, 'TEST', true, false),
            array(1, 1, -90, 1, 1, 1, true, 'TEST', true, true),
            array(1, 1, 180, 0, 2,  1, true, 'TEST', true, false),
            array(1, 1, 180, 10, 2,  1, true, 'TEST', true, false),
            array(1, 1, 180, 'a', 2,  1, true, 'TEST', true, false),
            array(1, 1, 270, 1, 7, 1, true, 'TEST', true, false),
            array(1, 1, 270, 1, 9, 1, true, 'TEST', true, false),
            array(1, 1, 270, 1, 0, 1, true, 'TEST', true, false),
            array(1, 1, 270, 1, 1, 0, true, 'TEST', true, false),
            array(1, 1, 270, 1, 1, 10, true, 'TEST', true, false),
        );
    }
}

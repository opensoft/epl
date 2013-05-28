<?php

namespace Epl\Tests\Command\Image;

use Epl\Command\Image\DataMatrixBarCodeCommand;
/**
 * @author Maria Plyasunova <maria.plyasunova@opensoftdev.ru>
 */
class DataMatrixBarCodeCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($horizontalStartPosition, $verticalStartPosition, $data, $barCodeSelection,
                                $minSquareSize, $columnsToEncode, $rowsToEncode, $inverseImage, $expectedResult)
    {
        $command = new DataMatrixBarCodeCommand($horizontalStartPosition, $verticalStartPosition, $data, $barCodeSelection,
            $minSquareSize, $columnsToEncode, $rowsToEncode, $inverseImage);

        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array(1, 2, 'TEST', 'D', 5, null, null, null, 'b1,2,D,h5,"TEST"' . chr(10)),
            array(2, 1, 'TEST', 'D', 5, null, null, null, 'b2,1,D,h5,"TEST"' . chr(10)),
            array(3, 3, 'TEST', 'D', 10, 1, 2, null, 'b3,3,D,c1,r2,h10,"TEST"' . chr(10)),
            array(2, 1, 'TEST', 'D', 5, null, null, 1, 'b2,1,D,h5,v1,"TEST"' . chr(10)),
            array(3, 3, 'TEST', 'D', 10, 1, 2, 1, 'b3,3,D,c1,r2,h10,v1,"TEST"' . chr(10)),
            array(2, 1, 'TE\ST', 'D', 5, null, null, 1, 'b2,1,D,h5,v1,"TE\\ST"' . chr(10)),
            array(2, 1, '"TEST"', 'D', 5, null, null, 1, 'b2,1,D,h5,v1,"\"TEST\""' . chr(10))
        );
    }


    /**
     * @test
     * @expectedException \Epl\ExceptionCommand
     * @dataProvider providerToEplStringException
     */
    public function toEplStringException($horizontalStartPosition, $verticalStartPosition, $data, $barCodeSelection,
                                $minSquareSize, $columnsToEncode, $rowsToEncode, $inverseImage)
    {
        $command = new DataMatrixBarCodeCommand($horizontalStartPosition, $verticalStartPosition, $data, $barCodeSelection,
            $minSquareSize, $columnsToEncode, $rowsToEncode, $inverseImage);

        $command->toEplString();
    }


    public function providerToEplStringException()
    {
        return array(
            array(1, 2, 'TEST', 'A', 5, null, null, null),
        );
    }
}

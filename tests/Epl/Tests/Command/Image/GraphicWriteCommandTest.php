<?php

namespace Epl\Tests\Command\Image;

use Epl\Command\Image\GraphicWriteCommand;

/**
 * @author Valeriy Fomin <valeriy.fomin@opensoftdev.ru>
 */
class GraphicWriteCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     *
     * @param integer $horizontalStartPosition
     * @param integer $verticalStartPosition
     * @param integer $width
     * @param integer $height
     * @param string $data
     * @param string $expectedResult
     */
    public function toEplString(
        $horizontalStartPosition,
        $verticalStartPosition,
        $width,
        $height,
        $data,
        $expectedResult
    ) {
        $command = new GraphicWriteCommand(
            $horizontalStartPosition,
            $verticalStartPosition,
            $width,
            $height,
            $data
        );

        $this->assertEquals($expectedResult, $command->toEplString());
    }

    /**
     * @test
     * @expectedException \Epl\ExceptionCommand
     * @dataProvider providerToEplStringException
     *
     * @param integer $horizontalStartPosition
     * @param integer $verticalStartPosition
     * @param integer $width
     * @param integer $height
     * @param string $data
     */
    public function toEplStringException(
        $horizontalStartPosition,
        $verticalStartPosition,
        $width,
        $height,
        $data
    ) {
        $command = new GraphicWriteCommand(
            $horizontalStartPosition,
            $verticalStartPosition,
            $width,
            $height,
            $data
        );

        $command->toEplString();
    }

    /**
     * @return array
     */
    public function providerToEplString()
    {
        return array(
            array(60, 1050, 2, 16, $this->getBinaryData(), 'GW60,1050,2,16,' . $this->getBinaryData() . chr(10)),
            array(false, 'string', 2.54, -16, $this->getBinaryData(), 'GW0,0,2,16,' . $this->getBinaryData() . chr(10))
        );
    }

    /**
     * @return array
     */
    public function providerToEplStringException()
    {
        return array(
            array(60, 1050, 20, 16, $this->getBinaryData()),
            array(60, 1050, 2, 16, $this->getBinaryData().'string'),
        );
    }

    /**
     * Returns binary string data of 16x16(px) square box.
     *
     * @return string
     */
    private function getBinaryData()
    {
        return pack('H*', '00007FFE7FFE7FFE7FFE7FFE7FFE7FFE7FFE7FFE7FFE7FFE7FFE7FFE7FFE0000');
    }
}

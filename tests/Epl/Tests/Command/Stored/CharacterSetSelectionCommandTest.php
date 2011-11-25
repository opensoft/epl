<?php

namespace Epl\Tests\Command\Stored;

use Epl\Command\Stored\CharacterSetSelectionCommand as Command;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CharacterSetSelectionCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function toEplString()
    {
        $command = new Command();
        $this->assertEquals('I8,0,001' . chr(10), $command->toEplString());

        $command = new Command(8);
        $this->assertEquals('I8,0,001' . chr(10), $command->toEplString());

        $command = new Command(7);
        $this->assertEquals('I7,0,001' . chr(10), $command->toEplString());

        $command = new Command(7, 8);
        $this->assertEquals('I7,8,001' . chr(10), $command->toEplString());

        $command = new Command(8, 13, '032');
        $this->assertEquals('I8,13,032' . chr(10), $command->toEplString());

        $command = new Command(8, '13', '032');
        $this->assertEquals('I8,13,032' . chr(10), $command->toEplString());

        $command = new Command(8, 'F', '027');
        $this->assertEquals('I8,F,027' . chr(10), $command->toEplString());
    }

    /**
     * @test
     * @dataProvider providerToEplStringException
     * @expectedException \Epl\ExceptionCommand
     */
    public function toEplStringException($numberOfDataBits, $printerCodePage, $KDUCountryCode)
    {
        $command = new Command($numberOfDataBits, $printerCodePage, $KDUCountryCode);
    }

    public function providerToEplStringException()
    {
        return array(
            array(6, 13, '032'),
            array(9, 'F', '027'),
            array(7, 9, '032'),
            array(8, 'u', '027'),
            array(8, 'a', '027'),
            array(8, 'x', '027'),
            array(8, 'F', '000'),
        );
    }
}

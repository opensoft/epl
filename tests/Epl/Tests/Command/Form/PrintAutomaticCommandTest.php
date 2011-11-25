<?php

namespace Epl\Tests\Command\Form;

use Epl\Command\Form\PrintAutomaticCommand;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class PrintAutomaticCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerConstructor
     */
    public function constructor($number, $copies, $expNumber, $expCopies)
    {
        $command = new PrintAutomaticCommand($number, $copies);
        $this->assertEquals($command->getNumberOfLabels(), $expNumber);
        $this->assertEquals($command->getNumberOfCopies(), $expCopies);
    }

    public function providerConstructor()
    {
        return array (
            array (1, null, 1, null),
            array (9998, 9998, 9998, 9998),
            array (9999, 9999, 9999, 9999),
        );
    }

    /**
     * @test
     * @dataProvider providerConstructorException
     * @expectedException \Epl\ExceptionCommand
     */
    public function consructorException($number, $copies)
    {
        $command = new PrintAutomaticCommand($number, $copies);
    }

    public function providerConstructorException()
    {
        return array (
            array (-1, null),
            array (1, 0),
            array (10000, null),
            array (1, 10000)
        );
    }

    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($number, $copies, $expResult)
    {
        $command = new PrintAutomaticCommand($number, $copies);
        $this->assertEquals($expResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array (
            array (1, 1, 'PA1,1' . chr(10)),
            array (1, null, 'PA1' . chr(10)),

        );
    }
}

<?php
/*
* This file is part of ProFIT
*
* Copyright (c) 2011 Farheap Solutions (http://www.farheap.com)
*
* The unauthorized use of this code outside the boundaries of
* Farheap Solutions Inc. is prohibited.
*/
namespace Epl\Tests\Command;

use Epl\Command\PrintCommand;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class PrintCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerConstructor
     */
    public function constructor($number, $copies, $expNumber, $expCopies)
    {
        $command = new PrintCommand($number, $copies);
        $this->assertEquals($command->getNumberOfLabels(), $expNumber);
        $this->assertEquals($command->getNumberOfCopies(), $expCopies);
    }

    public function providerConstructor()
    {
        return array (
            array (1, null, 1, null),
            array (1, 1, 1, 1),
        );
    }

    /**
     * @test
     * @dataProvider providerConstructorException
     * @expectedException \Epl\ExceptionCommand
     */
    public function consructorException($number, $copies)
    {
        $command = new PrintCommand($number, $copies);
    }

    public function providerConstructorException()
    {
        return array (
            array (-1, null),
            array (1, -11),
            array (6666667, null),
            array (1, 6666667)
        );
    }

    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($number, $copies, $expResult)
    {
        $command = new PrintCommand($number, $copies);
        $this->assertEquals($expResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array (
            array (1, 1, PrintCommand::NAME . '1,1'),
            array (1, null, PrintCommand::NAME . '1'),

        );
    }
}

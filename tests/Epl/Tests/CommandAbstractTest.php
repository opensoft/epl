<?php
/*
* This file is part of ProFIT
*
* Copyright (c) 2011 Farheap Solutions (http://www.farheap.com)
*
* The unauthorized use of this code outside the boundaries of
* Farheap Solutions Inc. is prohibited.
*/
namespace Epl\Tests;

use Epl\CommandAbstract;

class Command extends CommandAbstract
{
    protected function getName()
    {
        return 'Test';
    }
}
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CommandAbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerIsValidIntegerInterval
     */
    public function isValidIntegerInterval($name, $value, $min, $max, $expResult)
    {
        $command = new Command();
        $result = $command->isValidIntegerInterval($name, $value, $min, $max);
        $this->assertEquals($expResult, $result);
    }

    public function providerIsValidIntegerInterval()
    {
        return array (
            array ('name', 1, 0, 2, true)
        );
    }

    /**
     * @test
     */
    public function toEplString()
    {
        $command = new Command();
        $this->assertEquals('Test', $command->toEplString());
    }

    /**
     * @test
     * @dataProvider providerValidIntegerIntervalException
     * @expectedException \Epl\ExceptionCommand
     */
    public function isValidIntegerIntervalException($name, $value, $min, $max)
    {
        $command = new Command();
        $command->isValidIntegerInterval($name, $value, $min, $max);
    }

    public function providerValidIntegerIntervalException()
    {
        return array (
            array ('test', -1, 1, 3),
            array ('test', 3, 1, 2)
        );
    }
}

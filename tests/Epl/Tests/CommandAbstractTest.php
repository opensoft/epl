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
        $this->assertEquals('Test' . chr(13) . chr(10), $command->toEplString());
    }
}

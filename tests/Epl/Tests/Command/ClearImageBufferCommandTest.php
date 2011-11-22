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

use Epl\Command\ClearImageBufferCommand;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class ClearImageBufferCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function toEplString()
    {
        $command = new ClearImageBufferCommand();
        $this->assertEquals(chr(13) . chr(10) . ClearImageBufferCommand::NAME, $command->toEplString());
    }
}

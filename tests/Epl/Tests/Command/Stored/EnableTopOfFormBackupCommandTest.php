<?php

namespace Epl\Tests\Command\Stored;

use Epl\Command\Stored\EnableTopOfFormBackupCommand as Command;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class EnableTopOfFormBackupCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($expectedResult)
    {
        $command = new Command();
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array('JF' . chr(10))
        );
    }
}

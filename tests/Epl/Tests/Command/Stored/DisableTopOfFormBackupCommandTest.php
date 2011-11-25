<?php

namespace Epl\Tests\Command\Stored;

use Epl\Command\Stored\DisableTopOfFormBackupCommand as Command;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class DisableTopOfFormBackupCommandTest extends \PHPUnit_Framework_TestCase
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
            array(Command::NAME . '' . chr(10))
        );
    }
}

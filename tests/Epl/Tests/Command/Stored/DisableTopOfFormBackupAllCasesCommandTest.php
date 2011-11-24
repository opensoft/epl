<?php

namespace Epl\Tests\Command\Stored;

use Epl\Command\Stored\DisableTopOfFormBackupAllCasesCommand as Command;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class DisableTopOfFormBackupAllCasesCommandTest extends \PHPUnit_Framework_TestCase
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
            array(Command::NAME . '' . chr(13) . chr(10))
        );
    }
}

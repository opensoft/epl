<?php

namespace Epl\Tests\Command\Form;

use Epl\Command\Form\CommentLineCommand as Command;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CommentLineCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider providerToEplString
     */
    public function toEplString($commentData, $expectedResult)
    {
        $command = new Command($commentData);
        $this->assertEquals($expectedResult, $command->toEplString());
    }

    public function providerToEplString()
    {
        return array(
            array('Test', Command::NAME . ' Test' . chr(10)),
            array('T;s\\S"T@', Command::NAME . ' T;s\\S"T@' . chr(10))
        );
    }
}

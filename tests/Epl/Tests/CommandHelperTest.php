<?php

namespace Epl;

use Epl\CommandHelper as Command;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CommandTest extends \PHPUnit_Framework_TestCase
{
    private $composite;
    public function setUp()
    {
        $this->composite = new CommandComposite();
    }

    /**
     * @test
     */
    public function toEplString()
    {
        $command = new Command($this->composite);
        $command->asciiText(1, 1, 90, 1, 1, 1, false, 'TEST')
                ->barCode(1, 1, 90, 1, 1, 2, 1, true, 'TEST')
                ->rss14BarCode(1, 1, 0, 'RL', 1, 2, 1, false, '"123456789"')
                ->density(15)
                ->characterSetSelection()
                ->disableTopOfFormBackup()
                ->disableTopOfFormBackupAllCases()
                ->enableTopOfFormBackup()
                ->lineDrawExclusiveOR(10, 10, 20, 200)
                ->lineDrawBlack(10, 10, 20, 200)
                ->lineDrawDiagonal(10, 10, 20, 200, 200)
                ->lineDrawWhite(10, 10, 20, 200)
                ->clearImageBuffer()
                ->hardwareOption('C')
                ->hardwareOption('C', 'b')
                ->hardwareOption('C', 12)
                ->hardwareOption('F', 'r')
                ->printLabel(1)
                ->printLabel(1, 1)
                ->printAutomatic(1)
                ->printAutomatic(1, 1)
                ->setFormWidth(10)
                ->setFormLength(6, 24, 65535)
                ->setFormLength(6, 20)
                ->speed(10);
        $this->assertEquals('A1,1,1,1,1,1,N,"TEST"' . chr(10)
                          . 'B1,1,1,1,1,2,1,B,"TEST"' . chr(10)
                          . 'B1,1,0,RL,1,2,1,N,"\"123456789\""' . chr(10)
                          . 'D15' . chr(10)
                          . 'I8,0,001' . chr(10)
                          . 'JB' . chr(10)
                          . 'JC' . chr(10)
                          . 'JF' . chr(10)
                          . 'LE10,10,20,200' . chr(10)
                          . 'LO10,10,20,200' . chr(10)
                          . 'LS10,10,20,200,200' . chr(10)
                          . 'LW10,10,20,200' . chr(10)
                          . chr(10) . 'N' . chr(10)
                          . 'OC' . chr(10)
                          . 'OCb' . chr(10)
                          . 'OC12' . chr(10)
                          . 'OFr' . chr(10)
                          . 'P1' . chr(10)
                          . 'P1,1' . chr(10)
                          . 'PA1' . chr(10)
                          . 'PA1,1' . chr(10)
                          . 'q10' . chr(10)
                          . 'Q6,24+65535' . chr(10)
                          . 'Q6,20' . chr(10)
                          . 'S10' . chr(10)

                           , $command->toEplString());
    }
}

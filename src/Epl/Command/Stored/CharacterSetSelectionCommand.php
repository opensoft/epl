<?php

namespace Epl\Command\Stored;

use Epl\CommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Use this command to select the appropriate character set for printing (and KDU display)
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CharacterSetSelectionCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'I';

    /**
     * Number of data bits
     * Accepted values:
     * 8 = 8 bits
     * 7 = 7 bits
     * @var int
     */
    private $numberOfDataBits;

    /**
     * @var string Printer Code page
     */
    private $printerCodePage;

    /**
     * @var string KDU country code (8 bit data only)
     */
    private $KDUCountryCode;

    private $availableBits = array(7,8);

    private $availablePrinterCodePage = array(
        7 => array(
            '0', //USA
            '1', //British
            '2', //German
            '3', //French
            '4', //Danish
            '5', //Italian
            '6', //Spanish
            '7', //Swedish
            '8' //Swiss
        ),

        8 => array(
            '0', //DOS 437 English -US
            '1', //DOS 850 Latin 1
            '2', //DOS 852 Latin 2
            '3', //DOS 860 Portuguese
            '4', //DOS 863 French Canadian
            '5', //DOS 865 Nordic
            '6', //DOS 857 Turkish
            '7', //DOS 861 Icelandic
            '8', //DOS 862 Hebrew
            '9', //DOS 855 Cyrillic
            '10', //DOS 866 Cyrillic CIS 1
            '11', //DOS 737 Greek
            '12', //DOS 851 Greek 1
            '13', //DOS 869 Greek 2
            'A', //Windows 1252 Latin 1
            'B', //Windows 1250 Latin 2
            'C', //Windows 1251 Cyrillic
            'D', //Windows 1253 Greek
            'E', //Windows 1254 Turkish
            'F'  //Windows 1255 Hebrew
        )
    );

    private $availableKDUCountryCode = array(
        '032', //Belgium
        '002', //Canada
        '045', //Denmark
        '358', //Finland
        '033', //France
        '049', //Germany
        '031', //Netherlands
        '039', //Italy
        '003', //Latin America
        '047', //Norway
        '351', //Portugal
        '027', //South Africa
        '034', //Spain
        '046', //Sweden
        '041', //Switzerland
        '044', //U.K
        '001', //U.S.A
    );

    /**
     * @param int $numberOfDataBits
     * @param string $printerCodePage
     * @param string $KDUCountryCode
     * @throws \Epl\ExceptionCommand
     */
    public function __construct($numberOfDataBits = 8, $printerCodePage = '0', $KDUCountryCode = '001')
    {
        if ($this->isValidNumberOfDataBits($numberOfDataBits)) {
            $this->numberOfDataBits = (int) $numberOfDataBits;
        }

        if ($this->isValidPrinterCodePage($this->numberOfDataBits, $printerCodePage)) {
            $this->printerCodePage = $printerCodePage;
        }

        if ($this->isValidKDUCountryCode($KDUCountryCode)) {
            $this->KDUCountryCode = $KDUCountryCode;
        }

    }

    /**
     * @return string
     */
    protected function getName()
    {
        return self::NAME;
    }

    /**
     * @return string
     */
    public function toEplString()
    {
        $result = $this->getName() . $this->getNumberOfDataBits() . ',' . $this->getPrinterCodePage() . ','
                . $this->getKDUCountryCode() . $this->getSuffix();
        return $result;
    }

    /**
     * @return string
     */
    public function getKDUCountryCode()
    {
        return $this->KDUCountryCode;
    }

    /**
     * @return int
     */
    public function getNumberOfDataBits()
    {
        return $this->numberOfDataBits;
    }

    /**
     * @return string
     */
    public function getPrinterCodePage()
    {
        return $this->printerCodePage;
    }

    /**
     * @param $bit
     * @return bool
     * @throws \Epl\ExceptionCommand
     */
    protected function isValidNumberOfDataBits($bit)
    {
        foreach ($this->availableBits as $availableBit) {
            if ($availableBit === (int) $bit) {
                return true;
            }
        }
        throw ExceptionCommand::invalidNumberOfDataBits($bit);
    }

    /**
     * @param $bit
     * @param $printerCodePage
     * @return bool
     * @throws \Epl\ExceptionCommand
     */
    protected function isValidPrinterCodePage($bit, $printerCodePage)
    {
        foreach ($this->availablePrinterCodePage[$bit] as $code) {
            if ($code === (string) $printerCodePage) {
                return true;
            }
        }
        throw ExceptionCommand::invalidPrinterCodePage($bit, $printerCodePage);
    }

    /**
     * @param $countryCode
     * @return bool
     * @throws \Epl\ExceptionCommand
     */
    protected function isValidKDUCountryCode($countryCode)
    {
        foreach ($this->availableKDUCountryCode as $code) {
            if ($code === (string) $countryCode) {
                return true;
            }
        }
        throw ExceptionCommand::invalidKDUCountryCode($countryCode);
    }

}

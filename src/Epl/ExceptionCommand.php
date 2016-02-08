<?php

namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class ExceptionCommand extends \Exception
{
    /**
     * @static
     * @param string $name
     * @param $value
     * @param int $min
     * @param int $max
     * @return ExceptionCommand
     */
    public static function invalidIntegerParameter($name, $value, $min, $max)
    {
        return new self ('Accepted values: ' . $min .' to ' . $max .'. ' . $name . ' is ' .$value . '.');
    }

    /**
     * @static
     * @param $barcode
     * @return ExceptionCommand
     */
    public static function invalidBarCodeSelection($barcode)
    {
        return new self ($barcode . ' is invalid barcode selection');
    }

    /**
     * @static
     * @param $degree
     * @return ExceptionCommand
     */
    public static function invalidDegree($degree)
    {
        return new self ($degree . ' is invalid degree value');
    }

    /**
     * @static
     * @param $value
     * @return ExceptionCommand
     */
    public static function invalidNumberOfDataBits($value)
    {
        return new self ($value . ' is invalid number of data bits');
    }

    /**
     * @static
     * @param int $bit
     * @param $printerCodePage
     * @return ExceptionCommand
     */
    public static function invalidPrinterCodePage($bit, $printerCodePage)
    {
        return new self ($printerCodePage . ' is invalid for ' . $bit . 'bit data');
    }

    /**
     * @static
     * @param $countryCode
     * @return ExceptionCommand
     */
    public static function invalidKDUCountryCode($countryCode)
    {
        return new self ($countryCode . 'is invalid KDU country code');
    }

    /**
     * @static
     * @param $option
     * @return ExceptionCommand
     */
    public static function invalidHardwareOption($option)
    {
        return new self ($option . ' is invalid hardware option');
    }

    /**
     * @static
     * @param $option
     * @param $additionalOption
     * @return ExceptionCommand
     */
    public static function invalidHardwareAdditionalOption($option, $additionalOption)
    {
        return new self ($option . ' can not have the additional parameter');
    }

    /**
     * @static
     * @param $additionalOption
     * @return ExceptionCommand
     */
    public static function invalidHardwareAdditionalOptionForFeedSettings($additionalOption)
    {
        return new self ($additionalOption . ' is invalid hardware additional optional for feed settings');
    }

    /**
     * @static
     *
     * @param integer $actualDataSize in bytes
     * @param integer $expectedDataSize in bytes
     *
     * @return ExceptionCommand
     */
    public static function invalidDataSize($actualDataSize, $expectedDataSize)
    {
        return new self(sprintf(
                'Invalid data size. Expected size is %s bytes. Actual size is %s bytes.',
                $expectedDataSize,
                $actualDataSize)
        );
    }
}
